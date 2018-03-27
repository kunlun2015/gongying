<?php
/**
 * 我要反馈
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 10:00:43
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class Feedback extends CommonModel
{
    /**
     * 插入反馈记录
     * @param  array $data 反馈内容
     * @return boolen
     */
    public function save($data)
    {
        return $this->db->createCommand()->insert('{{%feedback}}', $data)->execute();
    }

    /**
     * 用户反馈列表
     * @param  int $suid       用户id
     * @param  int $page       页码
     * @param  int $pageSize   页面记录条数
     * @param  int &$totalPage 总页数
     * @return array
     */
    public function list($suid, $page, $pageSize, &$totalPage)
    {
        return $this->db->createCommand('select id, content, reply, replied_at, status, created_at from {{%feedback}} where suid = :suid order by id desc', ['suid' => $suid])->queryAll();
    }
}