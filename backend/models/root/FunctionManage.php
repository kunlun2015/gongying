<?php
/**
 * 功能管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-11 14:43:06
 * @version $Id$
 */

namespace backend\models\root;
use yii\base\Model;

class FunctionManage extends \backend\models\CommonModel{

    //添加功能分组
    public function addFunctionGroup($data){
        return $this->db->createCommand()->insert('{{%function_group}}', $data)->execute();
    }

    //获取功能分组列表
    public function functionGroupList(){
        return $this->db->createCommand('select id, name, sort, status, create_at from {{%function_group}} order by sort desc')->queryAll();
    }

    //获取一条分组数据
    public function oneFunctionGroupData($groupid){
        return $this->db->createCommand('select id, name, sort, status, remarks from {{%function_group}} where id = :groupid', array('groupid' => $groupid))->queryOne();
    }

   //更新分组数据
    public function editFunctionGroup($data, $groupid){
        return $this->db->createCommand()->update('{{%function_group}}', $data, array('id' => $groupid))->execute();
    }

    /**
     * 删除一条分组信息
     * 删除分组信息，同时删除此分组下的所有菜单信息
     */
    public function deleteFunctionGroup($groupid){       
        $transaction = $this->db->beginTransaction();
        try {
            $this->db->createCommand()->delete('{{%function_group}}', array('id' => $groupid))->execute();
            $this->db->createCommand()->delete('{{%function}}', array('groupid' => $groupid))->execute();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    //获取有效功能菜单分组
    public function availableFunctionGroup(){
        return $this->db->createCommand('select id, name from {{%function_group}} where status = 0 order by sort desc')->queryAll();
    }

    //添加功能菜单
    public function functionAdd($data){
        return $this->db->createCommand()->insert('{{%function}}', $data)->execute();
    }

    //删除功能菜单
    public function deleteFunctionMenu($id){
        $transaction = $this->db->beginTransaction();
        try {
            $this->db->createCommand()->delete('{{%function}}', array('id' => $id))->execute();
            //删除子菜单
            $subMenu = $this->db->createCommand('select id from {{%function}} where parent_id=:parent_id', array('parent_id' => $id))->queryAll();
            if($subMenu){
                foreach ($subMenu as $k => $v) {
                    $this->db->createCommand()->delete('{{%function}}', array('id' => $v['id']))->execute();
                    //删除子菜单
                    $subMenu2 = $this->db->createCommand('select id from {{%function}} where parent_id=:parent_id', array('parent_id' => $v['id']))->queryAll();
                    if($subMenu2){
                        foreach ($subMenu2 as $k2 => $v2) {
                            $this->db->createCommand()->delete('{{%function}}', array('id' => $v2['id']))->execute();
                        }
                    }
                }
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }
    }

    //编辑功能菜单
    public function functionEdit($data, $id){
        return $this->db->createCommand()->update('{{%function}}', $data, array('id' => $id))->execute();
    }

    //获取功能菜单列表
    public function functionMenuList($parent_id = 0){
        return $this->db->createCommand('select t1.id, parent_id, t1.name, icon, controller, method, groupid, t2.name as group_name, t1.status from {{%function}} as t1 left join {{%function_group}} as t2 on t1.groupid = t2.id where parent_id = :parent_id order by t1.sort desc', array('parent_id' => $parent_id))->queryAll();
    }

    //获取一条菜单信息
    public function oneFunctionMenu($id){
        return $this->db->createCommand('select id, parent_id, icon, name, controller, method, url, groupid, status, sort, remarks from {{%function}} where id = :id', array('id' => $id))->queryOne();
    }

    //判断当前功能菜单层级
    public function getFunctionMenuLevelByPid($pid){
        $level = 1;
        $menu = $this->db->createCommand('select parent_id from {{%function}} where id = :parent_id', array('parent_id' => $pid))->queryOne();
        if($menu['parent_id']){
            $level = 2;
        }else{
            $level = 1;
        }
        return $level + 1;
    }
}