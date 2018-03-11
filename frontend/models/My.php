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
}