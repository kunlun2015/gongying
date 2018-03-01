<?php
/**
 * tags model
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-07 12:56:58
 * @version $Id$
 */

namespace backend\models;
use function foo\func;
use yii\base\Model;

class Tags extends CommonModel
{
    
    /**
     * 新增标签
     */
    public function insert($data)
    {
        return $this->db->createCommand()->insert('{{%tags}}', $data)->execute();
    }

    //修改标签
    public function update($data, $id)
    {
        return $this->db->createCommand()->update('{{%tags}}', $data, ['id' => $id])->execute();
    }

    /**
     * 标签详情
     * @param int $id 标签id
     * @return array
     */
    public function detail($id)
    {
        return $this->db->createCommand('select id, cate, name, nums, remarks, create_at, created from {{%tags}} where id = :id', ['id' => $id])->queryOne();
    }

    /**
     * 输出分类标签
     * @param int $cate 分类id
     * @return array
     */
    public function cateTags($cate)
    {
        return $this->db->createCommand('select id, name, nums from {{%tags}} where cate = :cate', ['cate' => $cate])->queryAll();
    }

    /**
     * 标签列表
     * @param int $cate 分类
     * @param int $pageSize 每页记录数
     * @param int $page 页码
     * @param int $totalPage 总页数
     */
    public function tagsList($cate, $pageSize, $page, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select id, cate, name, nums, created, create_at from {{%tags}} where 1 = 1';
        $sqlTotal = 'select count(*) from {{%tags}} where 1 = 1';
        if($cate){
            $sql .= ' and cate = '.$cate;
            $sqlTotal .= ' and cate = '.$cate;
        }
        $sql .= ' order by id desc limit :offset, :pageSize';
        $list = $this->db->createCommand($sql, ['offset' => $offset, 'pageSize' => $pageSize])->queryAll();
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $list;
    }
}