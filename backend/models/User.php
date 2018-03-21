<?php
/**
 * 
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-21 17:48:39
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class User extends CommonModel{

    /**
     * 用户列表
     * @param  int $page       页码
     * @param  int $pageSize   页面记录条数
     * @param  int &$totalPage 总页数
     * @return array
     */
    public function userList($username, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select id, username, openid, avatar, mobile, status, created_at from {{%site_users}} where 1 = 1';
        $sqlTotal = 'select count(*) from {{%site_users}} where 1 = 1';
        if($username){
            $sql .= " and username like '%$username%' order by id desc";
            $sqlTotal .= " and username like '%$username%'";
        }
        $sql .= ' limit :offset, :pageSize';
        $list = $this->db->createCommand($sql, ['offset' => $offset, 'pageSize' => $pageSize])->queryAll();
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $list;
    }

    /**
     * 返回用户修改项信息
     * @param  int $suid 用户uid
     * @return array
     */
    public function getEditInfo($suid)
    {
        return $this->db->createCommand('select id, status from {{%site_users}} where id = :suid', ['suid' => $suid])->queryOne();
    }

    /**
     * 保存用户信息
     * @param  int $suid 用户uid
     * @param  array $data 更新数据
     * @return boolen
     */
    public function save($suid, $data)
    {
        return $this->db->createCommand()->update('{{%site_users}}', $data, ['id' => $suid])->execute();
    }

}