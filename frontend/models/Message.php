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
            return $rid;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
            return false;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
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

}