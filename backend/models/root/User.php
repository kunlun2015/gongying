<?php
/**
 * 用户
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 16:57:05
 * @version $Id$
 */

namespace backend\models\root;
use yii\base\Model;

class User extends \backend\models\CommonModel{

    //用户列表
    public function userList($page_size, $page, &$total_page){
        $offset = ($page - 1)*$page_size;
        $rst = $this->db->createCommand("select id, username, realname, avatar, mobile, login_times, last_login_time, status from {{%users}} order by id desc limit $offset, $page_size")->queryAll();
        $sql_total = 'select count(*) from {{%users}}';
        $total_page = $this->getTotalPage($sql_total, $page_size);
        return $rst;
    }

    //添加用户
    public function addUser($data){
        $transaction = $this->db->beginTransaction();
        try {
            $this->db->createCommand()->insert('{{%users}}', [
                    'username' => $data['username'],
                    'mobile' => $data['mobile'],
                    'remarks' => $data['remarks']
                ])->execute();
            $uid = $this->db->getLastInsertId();
            $encrypt = $this->randString(8);
            $this->db->createCommand()->insert('{{%login_psd}}', [
                    'uid' => $uid,
                    'password' => $this->genPassword($data['password'], $encrypt),
                    'encrypt' => $encrypt
                ])->execute();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            //throw $e;
            return false;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            //throw $e;
            return false;
        }
    }

    //获取修改用户信息
    public function getEditUser($uid){
        return $this->db->createCommand('select id, username, realname, mobile, remarks, status from {{%users}} where id = :uid', array('uid' => $uid))->queryOne();
    }

    //修改用户
    public function editUser($data){
        return $this->db->createCommand()->update('{{%users}}', $data, array('id' => $data['id']))->execute();
    }

    //生成menu tree
    public function menuLevelTree(){
        $menu = array();
        $group = (new FunctionManage)->availableFunctionGroup();
        $i = 0;
        foreach ($group as $k => &$v) {
            $menu[$i]['text']    = $v['name'];
            $menu[$i]['groupid'] = $v['id'];
            $menu[$i]['li_attr'] = array('class' => 'menu-group', 'data_id' => $v['id']);
            $firstLevelMenu = $this->getFirstLevalMenuByGroupId($v['id']);
            if(!$firstLevelMenu){
                unset($menu[$i]);
                $i += 1;
                continue;
            }     
            $menu[$i]['children'] = $firstLevelMenu;
            $j = 0;
            foreach ($firstLevelMenu as $kFirstLevelMenu => &$vFirstLevelMenu) {
                $menu[$i]['children'][$j]['li_attr'] = array('class' => 'menu-function', 'data_id' => $vFirstLevelMenu['id']);
                $secondLevelMenu = $this->getMenuListByParentId($vFirstLevelMenu['id']);
                $menu[$i]['children'][$j]['children'] = $secondLevelMenu;
                $k = 0;
                foreach ($secondLevelMenu as $kSecondLevelMenu => $vSecondLevelMenu) {
                     $menu[$i]['children'][$j]['children'][$k]['li_attr'] = array('class' => 'menu-function', 'data_id' => $vSecondLevelMenu['id']);
                    $thirdLevelMenu = $this->getMenuListByParentId($vSecondLevelMenu['id']);
                    $menu[$i]['children'][$j]['children'][$k]['children'] = $thirdLevelMenu;
                    $l = 0;
                    foreach ($thirdLevelMenu as $kThirdLevelMenu => $vThirdLevelMenu) {
                        $menu[$i]['children'][$j]['children'][$k]['children'][$l]['li_attr'] = array('class' => 'menu-function', 'data_id' => $vThirdLevelMenu['id']);
                        $l += 1;
                    }
                    $k += 1;
                }
                $j += 1;
            }
            $i += 1;
        }
        return $menu;
    }

    //获取分组下的一级菜单
    private function getFirstLevalMenuByGroupId($groupid){
        return $this->db->createCommand('select id, name as text from {{%function}} where groupid = :groupid and parent_id = 0 and status = 0 order by sort desc', array('groupid' => $groupid))->queryAll();
    }

    //根据parent_id获取菜单树的list
    private function getMenuListByParentId($parent_id){
        return $this->db->createCommand('select id, name as text from {{%function}} where parent_id = :parent_id and status = 0 order by sort desc', array('parent_id' => $parent_id))->queryAll();
    }

    //更新用户菜单权限
    public function updateUserMenuAuthority($uid, $authority){
        return $this->db->createCommand()->update('{{%user_menu_authority}}', array('authority' => $authority), array('uid' => $uid))->execute();
    }

    //用户当前权限
    public function userMenuAuthority($uid){
        $authority = $this->db->createCommand('select authority from {{%user_menu_authority}} where uid = :uid', array('uid' => $uid))->queryOne();
        $menuAuthority = explode('|', $authority['authority']);
        if(count($menuAuthority) === 3){
            $menuAuthority[0] = $menuAuthority[0] ? $menuAuthority[0] : 0;
            $menuAuthority[1] = $menuAuthority[1] ? $menuAuthority[1] : 0;
            $menuAuthority[2] = $menuAuthority[2] ? $menuAuthority[2] : 0;
        }else{            
            $menuAuthority = array(0, 0, 0);
        }
        return $menuAuthority;
    }
}