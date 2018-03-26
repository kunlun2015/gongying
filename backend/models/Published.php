<?php
/**
 * 发布数据管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 09:20:32
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class Published extends CommonModel
{

    /**
     * 发布数据列表
     * @param  int $type       发布类型，1求购，2供应
     * @param  int $status     状态，1：审核中，2：审核通过，3：审核未通过
     * @param  string $username   发布用户名
     * @param  string $title      发布标题
     * @param  int $page       页码
     * @param  int $pageSize   页码记录条数
     * @param  int &$totalPage 总页数
     * @return array
     */
    public function list($type, $status, $username, $title, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select t1.id, type, fid, title, t1.status, username, t1.created_at from {{%published}} as t1 left join {{%site_users}} as t2 on t1.suid = t2.id where 1 = 1';
        $sqlTotal = 'select count(*) from {{%published}} as t1 left join {{%site_users}} as t2 on t1.suid = t2.id where 1 = 1';
        if($type){
            $sql .= " and type = $type";
            $sqlTotal .= " and type = $type";
        }
        if($status){
            $sql .= " and t1.status = $status";
            $sqlTotal .= " and t1.status = $status";
        }
        if($username){
            $sql .= " and username like '$username%'";
            $sqlTotal .= " and username like '$username%'";
        }
        if($title){
            $sql .= " and title like '%$title%'";
            $sqlTotal .= " and title like '%$title%'";
        }
        $sql .= " order by updated_at desc limit $offset, $pageSize";
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        $list = $this->db->createCommand($sql)->queryAll();
        return $list;
    }

    /**
     * 获取待更新的信息
     * @param  int $pid 发布pid
     * @return []
     */
    public function getEditInfo($pid)
    {
        return $this->db->createCommand('select id, status from {{%published}} where id = :pid', ['pid' => $pid])->queryOne();
    }

    /**
     * 更新发布信息
     * @param  int $pid 发布pid
     * @param  array $data 更新数据
     * @return boolen
     */
    public function update($pid, $data)
    {
        return $this->db->createCommand()->update('{{%published}}', $data, ['id' => $pid])->execute();
    }

    /**
     * 删除发布的内容
     * @param  int $pid 发布pid
     * @return boolen
     */
    public function delete($pid)
    {
        return $this->db->createCommand()->delete('{{%published}}', ['id' => $pid])->execute();
    }

    /**
     * 发布详情
     * @param  int $pid 发布pid
     * @return array
     */
    public function detail($pid)
    {
        $detail = $this->db->createCommand('select t1.id, suid, username, fid, sid, tid, type, title, num, budget, delivery_cycle, deadline, delivery_area, description, pictures, anonymous, t1.status, t1.created_at, updated_at from {{%published}} as t1 left join {{%site_users}} as t2 on t1.suid = t2.id where t1.id = :pid', ['pid' => $pid])->queryOne();
        if($detail){
            $category = new Category;
            $detail['fname'] = $category->detail($detail['fid'])['name'];
            $detail['sname'] = $category->detail($detail['sid'])['name'];
            $detail['tname'] = $category->detail($detail['tid'])['name'];
            $detail['pictures'] = explode(',', $detail['pictures']);
        }        
        return $detail;
    }
}