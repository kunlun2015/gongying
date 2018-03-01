<?php
/**
 * category manage
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-27 09:21:28
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class Category extends CommonModel
{

    //添加分类数据
    public function addCategory($data)
    {
        return $this->db->createCommand()->insert('{{%category}}', $data)->execute();
    }

    //编辑分类数据
    public function editCategory($id, $data)
    {
        return $this->db->createCommand()->update('{{%category}}', $data, ['id' => $id])->execute();
    }

    //删除分类数据
    public function deleteCategory($id)
    {
        return $this->db->createCommand()->delete('{{%category}}', ['id' => $id])->execute();
    }

    //获取分类列表数据
    public function categoryList($parentId)
    {
        return $this->db->createCommand('select id, pid, name, sort, href, status, created, create_at from {{%category}} where pid = :pid', array('pid' => $parentId))->queryAll();
    }

    //获取当前分类的层级关系数组
    public function categoryLevel($id, $levelArray=[])
    {
        $category = $this->db->createCommand('select id, pid, name from {{%category}} where id = :id', array('id' => $id))->queryOne();
        if(!$category){
            return [];
        }
        if(!$category['pid']){
            $levelArray[] = $category;
            krsort($levelArray);
            return $levelArray;
        }else{
            $levelArray[] = $category;
            return $this->categoryLevel($category['pid'], $levelArray);
        }
    }

    //获取菜单的详细信息
    public function detail($id)
    {
        $detail = $this->db->createCommand('select id, pid, name, href, sort, status, remarks, create_at, created from {{%category}} where id = :id', ['id' => $id])->queryOne();
        return $detail;
    }

    //获取当前子菜单列表
    public function subCateList($pid)
    {
        return $this->db->createCommand('select id, name from {{%category}} where pid = :pid order by sort desc', ['pid' => $pid])->queryAll();
    }

    //获取向上的层级关系
    public function categoryLevelByLastLevel($lid, $level = [])
    {
        $detail = $this->detail($lid);
        array_unshift($level, $detail);
        if($detail['pid'] != 0){
            return $this->categoryLevelByLastLevel($detail['pid'], $level);
        }else{
            return $level;
        }
    }

    //当前层级元素的菜单列表
    public function categoryLevelList($levelArr)
    {
        $list = [];
        foreach ($levelArr as $k => $v){
            $list[$k] = $v;
            $list[$k]['list'] = $this->subCateList($v['pid']);
        }
        return $list;
    }
}