<?php
/**
 * 站点信息管理
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-23 13:05:08
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class SiteInfo extends CommonModel
{

    public function add($data)
    {
        return $this->db->createCommand()->insert('{{%common_page_text}}', $data)->execute();
    }

    public function edit($id, $data)
    {
        return $this->db->createCommand()->update('{{%common_page_text}}', $data, ['id' => $id])->execute();
    }

    public function detail($id)
    {
        return $this->db->createCommand('select id, title, content from {{%common_page_text}} where id = :id', ['id' => $id])->queryOne();
    }

    public function siteInfoList($page, $pageSize, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $list = $this->db->createCommand('select id, title, created, create_at from {{%common_page_text}} order by id asc limit :offset, :pageSize', ['offset' => $offset, 'pageSize' => $pageSize])->queryAll();
        $totalPage = $this->getTotalPage('select count(*) from {{%common_page_text}}', $pageSize);
        return $list;
    }

}