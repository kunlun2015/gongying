<?php
/**
 * 消息model
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-15 15:27:10
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\db\Expression;
use yii\helpers\Url;

class Message extends CommonModel
{
    /**
     * 创建聊天回话
     * @param  array $data 
     * @return int/boolen rid/flase
     */
    public function insert($rid, $data)
    {
        $transaction = $this->db->beginTransaction();
        try {
            if($rid){
                //更新聊天室
                $rst = $this->db->createCommand()->update('{{%message_room}}', [
                    'last_message' => $data['message'],
                    'nums' => new Expression('nums+ 1'),
                    'updated_at' => $data['time']
                ], ['id' => $rid])->execute();
                //更新消息状态
                $this->db->createCommand()->update('{{%message_users}}', ['isnew' => 1], ['rid' => $rid, 'suid' => $data['to_suid']])->execute();
            }else{
                //创建聊天室
                $this->db->createCommand()->insert('{{%message_room}}', [
                    'suid' => $data['suid'],
                    'to_suid' => $data['to_suid'],
                    'last_message' => $data['message'],
                    'nums' => 1,
                    'updated_at' => $data['time'],
                    'created_at' => $data['time']
                ])->execute();
                $rid = $this->db->getLastInsertID();
                //创建用户参与记录
                $this->db->createCommand()->insert('{{%message_users}}', [
                    'rid' => $rid,
                    'suid' => $data['suid']
                ])->execute();
                $this->db->createCommand()->insert('{{%message_users}}', [
                    'rid' => $rid,
                    'suid' => $data['to_suid'],
                    'isnew' => 1
                ])->execute();
            }
            //插入消息记录
            $this->db->createCommand()->insert('{{%message_text}}', [
                'rid' => $rid,
                'suid' => $data['suid'],
                'message_text' => $data['message'],
                'created_at' => $data['time']
            ])->execute();
            $transaction->commit();
            //模板消息通知
            if(!$this->app->cache->get($rid.'-'.$data['to_suid'])){
                $user = new User;
                $notifyUser = $user->userUInfoByUid($data['to_suid']);
                $myInfo = $user->userUInfoByUid($data['suid']);
                $templateMsgData = [
                    'touser' => $notifyUser['openid'],
                    'template_id' => 'KGNI9no-_UVxYgWJ6VQHkfca8Toi2-_SzTbfEHCQP04',
                    'url' => Url::to(['/message'], true),
                    'data' => [
                        'username' => [
                            'value' => $myInfo['username'],
                            'color' => '#173177'
                        ]
                    ]
                ];
                $sendRst = (new Wx)->sendTemplateMsg($templateMsgData);
                if($sendRst != false){
                    $this->app->cache->set($rid.'-'.$data['to_suid'], time(), 300);
                }
            }            
            return $rid;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 是否有过对话记录
     * @return boolean/rid
     */
    public function isHasMessaged($suid, $toSuid)
    {
        $ridInfo = $this->db->createCommand('select id from {{%message_room}} where (suid = :suid and to_suid = :toSuid) or (suid = :toSuid and to_suid = :suid)', ['suid' => $suid, 'toSuid' => $toSuid])->queryOne();
        return $ridInfo ? $ridInfo['id'] : false;
    }

    /**
     * 消息列表
     * @param  int $suid       用户suid
     * @param  int $page        页码 
     * @param  int $pageSize   每页条数
     * @param  int &$totalPage 总页数
     * @return array
     */
    public function messageList($suid, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $list = $this->db->createCommand('select rid, t2.suid, isnew, to_suid, last_message, updated_at from {{%message_users}} as t1 left join {{%message_room}} as t2 on t1.rid = t2.id where t1.suid = :suid order by t2.updated_at desc limit :offset, :pageSize', [
            'suid' => $suid,
            'offset' => $offset,
            'pageSize' => $pageSize
        ])->queryAll();
        foreach ($list as $k => $v) {
            $toUser = $this->db->createCommand('select username, avatar from {{%site_users}} where id = :toUserId', ['toUserId' => $v['suid'] == $suid ? $v['to_suid'] : $v['suid']])->queryOne();
            $list[$k] = array_merge($list[$k], $toUser);
        }
        $sqlTotal = 'select count(*) from {{%message_users}} where suid = '.$suid;
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $list;
    }

    /**
     * 消息记录详情
     * @param  int $rid        聊天室id
     * @param  int $page       页码 
     * @param  int $pageSize   每页条数
     * @param  int &$totalPage 总页数
     * @return array
     */
    public function messageDetail($rid, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $list = $this->db->createCommand('select t1.id, rid, suid, username, avatar, message_text, t1.status, t1.created_at from {{%message_text}} as t1 left join {{%site_users}} as t2 on t1.suid = t2.id where rid = :rid order by t1.id asc limit :offset, :pageSize', [
            'rid' => $rid,
            'offset' => $offset,
            'pageSize' => $pageSize
        ])->queryAll();
        $sqlTotal = 'select count(*) from {{%message_text}} where rid = '.$rid;
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $list;
    }

    /**
     * 是否有新消息
     * @param  int  $suid 用户uid
     * @return boolean
     */
    public function isHasNewMessage($suid)
    {
        $newMessage = $this->db->createCommand('select id from {{%message_users}} where suid = :suid and isnew = 1', ['suid' => $suid])->queryOne();
        return $newMessage ? true : false;
    }

    /**
     * 标记消息为已读
     * @param  int $roomId 聊天室id
     * @param  int $suid   用户suid
     * @return boolen
     */
    public function markMessageReaded($roomId, $suid)
    {
        return $this->db->createCommand()->update('{{%message_users}}', ['isnew' => 0], ['rid' => $roomId, 'suid' => $suid])->execute();
    }

}