<?php
/**
 * 
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-23 10:30:52
 * @version $Id$
 */

namespace console\models;
use yii;
use yii\base\Model;

class Posts extends CommonModel {

    public function list()
    {
        $list = $this->db->createCommand('select id, fid, lid, author, title, abstract, thumbnail, views, create_at from {{%post_basic}} where status = 0 order by id desc')->queryAll();
        foreach ($list as $k => $v) {
            $fidInfo = $this->getPostCateById($v['fid']);
            $lidInfo = $this->getPostCateById($v['lid']);
            $list[$k]['fname'] = $fidInfo['name'];
            $list[$k]['lname'] = $lidInfo['name'];
            $list[$k]['fmap'] = $this->params['cateMap'][$v['fid']];
        }
        return $list;
    }

    /**
     * 根据类别id获取名称
     * @param int $id 类别名称
     * @return array
     */
    public function getPostCateById($id)
    {
        return $this->db->createCommand('select id, pid, name, href from {{%category}} where id = :id', ['id' => $id])->queryOne();
    }
}