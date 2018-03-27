<?php
/**
 * 反馈管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 10:54:17
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class Feedback extends CommonModel
{
    public function list($status, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select t1.id, suid, username, content, reply, replied_at, t1.status, t1.created_at from {{%feedback}} as t1 left join {{%site_users}} as t2 on t1.suid = t2.id where 1 = 1';
        $sqlTotal = 'select count(*) from {{%feedback}} where 1 = 1';
        if($status != ''){
            $sql .= " and t1.status = $status";
            $sqlTotal .= " and status = $status";
        }
        $sql .= " order by id desc limit $offset, $pageSize";
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $this->db->createCommand($sql)->queryAll();
    }

    /**
     * 更新反馈内容
     * @param  int $id   反馈id
     * @param  array $data 
     * @return boolen
     */
    public function update($id, $data)
    {
        return $this->db->createCommand()->update('{{%feedback}}', $data, ['id' => $id])->execute();
    }

    /**
     * 反馈详情
     * @param  int $id 反馈id
     * @return array
     */
    public function detail($id)
    {
        return $this->db->createCommand('select t1.id, suid, username, avatar, content, reply, replied_at, t1.status, t1.created_at from {{%feedback}} as t1 left join {{%site_users}} as t2 on t1.suid = t2.id where t1.id = :id', ['id' => $id])->queryOne();
    }
}