<?php
/**
 * 微信相关model
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-02 14:19:04
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class Wechat extends CommonModel{

    /**
     * 添加微信账号
     * @param array $data 
     * @return boolen
     */
    public function addAccount($data)
    {
        return $this->db->createCommand()->insert('{{%wx_account}}', $data)->execute();
    }

    /**
     * 更新微信账号信息
     * @param  int $id   账号id
     * @param  array $data 待更新的数据
     * @return boolen
     */
    public function editAccount($id, $data)
    {
        return $this->db->createCommand()->update('{{%wx_account}}', $data, ['id' => $id])->execute();
    }

    /**
     * 账号详情
     * @param  int $id 帐号id
     * @return array
     */
    public function getAccount($id)
    {
        return $this->db->createCommand('select id, name, wx_id, appid, appsecret, remarks from {{%wx_account}} where id = :id', ['id' => $id])->queryOne();
    }

    /**
     * 账号列表
     * @param  int $page  页码
     * @param  int $pageSize 偏移量
     * @return array
     */
    public function accountList($page, $pageSize)
    {
        $offset = ($page - 1) * $pageSize;
        $list = $this->db->createCommand('select id, name, wx_id, appid, appsecret, remarks, create_at from {{%wx_account}} order by id desc limit :offset, :pageSize', ['offset' => $offset, 'pageSize' => $pageSize])->queryAll();
        return $list;
    }

    /**
     * 添加微信回复关键字
     * @param boolen
     */
    public function addReplyKeywords($data)
    {
        return $this->db->createCommand()->insert('{{%wx_reply_keywords}}', $data)->execute();
    }

    /**
     * 更新微信回复关键字
     * @param  int $id 
     * @param  array $data
     * @return boolen
     */
    public function updateReplyKeywords($id, $data)
    {
        return $this->db->createCommand()->update('{{%wx_reply_keywords}}', $data, ['id' => $id])->execute();
    }

}