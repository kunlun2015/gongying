<?php
/**
 * 我的
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-10 16:55:51
 * @version 1.0
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class My extends CommonModel
{
   
   /**
    * 我的发布列表
    * @param  int $suid       我的uid
    * @param  int $type       1采购，2供应
    * @param  int $page       页码
    * @param  int $pageSize   页面记录条数
    * @param  int &$totalPage 总页数
    * @return array
    */
    public function published($suid, $type, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select id, fid, sid, tid, title, num, delivery_area, pictures from {{%published}} where suid = '.$suid;
        $sqlTotal = 'select count(*) from {{%published}} where 1 = 1';
        if($type && in_array($type, [1, 2])){
            $sql .= ' and type = '.$type;
            $sqlTotal .= ' and type = '.$type;
        }
        $sql .= ' order by updated_at desc limit '.$offset.','.$pageSize;
        $list = $this->db->createCommand($sql)->queryAll();
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        $classify = new Classify;
        foreach ($list as $k => $v) {
            $list[$k]['pictures'] = explode(',', $v['pictures']);
            $list[$k]['fname'] = $classify->classifyById($v['fid'])['name'];
            $list[$k]['sname'] = $classify->classifyById($v['sid'])['name'];
            $list[$k]['tname'] = $classify->classifyById($v['tid'])['name'];
        }
        return $list;
    }

    /**
     * 更新我的信息
     * @param  int $suid 
     * @param  array $data 待更新的数据
     * @return boolen
     */
    public function update($suid, $data)
    {
        return $this->db->createCommand()->update('{{%site_users}}', $data, ['id' => $suid])->execute();
    }

    /**
     * 我的收藏列表 
     * @param  int $suid       我的uid
     * @param  int $type       1采购，2供应
     * @param  int $type       1采购，2供应
     * @param  int $page       页码
     * @param  int $pageSize   页面记录条数
     * @param  int &$totalPage 总页数
     * @return array
     */
    public function collected($suid, $type, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $list = $this->db->createCommand('select t1.id, fid, sid, tid, title, num, delivery_area, pictures from {{%collection}} as t1 left join {{%published}} as t2 on t1.pid = t2.id where t1.suid = :suid and t2.type = :type order by id desc limit :offset, :pageSize', ['suid' => $suid, 'type' => $type, 'offset' => $offset, 'pageSize' => $pageSize])->queryAll();
        $classify = new Classify;
        foreach ($list as $k => $v) {
            $list[$k]['pictures'] = explode(',', $v['pictures']);
            $list[$k]['fname'] = $classify->classifyById($v['fid'])['name'];
            $list[$k]['sname'] = $classify->classifyById($v['sid'])['name'];
            $list[$k]['tname'] = $classify->classifyById($v['tid'])['name'];
        }
        $sqlTotal = 'select count(*) from {{%collection}} as t1 left join {{%published}} as t2 on t1. pid = t2.id where t1.suid = '.$suid .' and type = '.$type;
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $list;
    }

    /**
     * 删除收藏的内容
     * @param  int $suid 用户uid
     * @param  int $id  收藏id
     * @return boolen
     */
    public function deleteCollected($suid, $id)
    {
        return $this->db->createCommand()->delete('{{%collection}}', ['suid' => $suid, 'id' => $id])->execute();
    }

    /**
     * 获取用户更新信息
     * @param  int $suid 用户uid
     * @return array
     */
    public function getEditInfo($suid)
    {
        return $this->db->createCommand('select username, mobile,company, position from {{%site_users}} where id = :suid', ['suid' => $suid])->queryOne();
    }
}