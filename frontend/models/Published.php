<?php
/**
 * publish
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-08 10:36:53
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class Published extends CommonModel
{
    /**
     * 保存发布
     * @param  array $data 表单数据
     * @return boolen
     */
    public function save($data)
    {
        return $this->db->createCommand()->insert('{{%published}}', $data)->execute();
    }

    /**
     * 首页数据列表
     * @param  int $type 数据类型 1求购(订单)，2供应
     * @param  [type] $pageSize 数据条数
     * @return array
     */
    public function indexList($type, $pageSize)
    {
        $list = $this->db->createCommand('select id, fid, sid, tid, title, num, delivery_area, pictures from {{%published}} where type = :type order by updated_at desc limit :pageSize', ['type' => $type, 'pageSize' => $pageSize])->queryAll();
        $classify = new Classify;
        foreach ($list as $k => $v) {
            $list[$k]['pictures'] = explode(',', $v['pictures']);
            $list[$k]['fname'] = $classify->classifyById($v['fid'])['name'];
            $list[$k]['sname'] = $classify->classifyById($v['sid'])['name'];
            $list[$k]['tname'] = $classify->classifyById($v['tid'])['name'];
        }
        return $list;
    }

    public function dataList($type, $keywords, $fid, $page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select id, fid, sid, tid, title, num, delivery_area, pictures from {{%published}} where 1 = 1';
        $sqlTotal = 'select count(*) from {{%published}} where 1 = 1';
        if($type && in_array($type, [1, 2])){
            $sql .= ' and type = '.$type;
            $sqlTotal .= ' and type = '.$type;
        }
        if($fid){
            $sql .= ' and fid = '.$fid; 
            $sqlTotal .= ' and fid = '.$fid; 
        }
        if($keywords){
            $sql .= " and title like '%$keywords%'";
            $sqlTotal .= " and title like '%$keywords%'";
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
}