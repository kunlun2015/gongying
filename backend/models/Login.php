<?php
/**
 * 登录控制
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-06 18:03:50
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class Login extends CommonModel{

    private $user;

    //登录验证
    public function loginCheck($username, $password, $user_ip){
        $this->user = $this->db->createCommand('select id, username, avatar, login_times, last_login_time, last_login_ip from {{%users}} where username = :username', array('username' => $username))->queryOne();
        if(!$this->user){
            return -1;
        }
        $passwordSaved = $this->db->createCommand('select password, encrypt from {{%login_psd}} where uid = :uid', ['uid' => $this->user['id']])->queryOne();
        if(!$this->verifyPassword($password, $passwordSaved['password'], $passwordSaved['encrypt'])){
            return -2;
        }
        $this->loginSuccess($user_ip);
        $this->userLoginStatusKeep();
        return true;
    }

    //用户登录成功
    private function loginSuccess($user_ip){
        /**
         * 更新上次登录ip
         * 更新登录次数
         * 更新登录时间
         */
        $this->db->createCommand('update {{%users}} set login_times = login_times + 1, last_login_time = :last_login_time, last_login_ip = :last_login_ip where id = '.$this->user['id'], array('last_login_ip' => $user_ip, 'last_login_time' => date('Y-m-d H:i:s')))->execute();
        return true;
    }

    //用户登录状态存储
    private function userLoginStatusKeep(){
        $session_info = array(
            'id'              => $this->user['id'],
            'username'        => $this->user['username'],
            'avatar'          => $this->user['avatar'],
            'login_times'     => $this->user['login_times'],
            'last_login_time' => $this->user['last_login_time'],
            'last_login_ip'   => $this->user['last_login_ip']
        );
        $this->session->set('user', $session_info);
        return true;
    }

    //获取用户权限菜单
    public function userAuthorityMenuLevel($uid){
        $authority = $this->menuAuthority($uid);
        $menu = array();
        $group = $this->db->createCommand('select id, name from {{%function_group}} where id in ('.$authority['menuGroupId'].') and status = 0 order by sort desc')->queryAll();
        $i = 0;
        foreach ($group as $kGroup => $vGroup) {
            //分组
            $menu[$i] = $vGroup;
            //一级菜单            
            $firstLevelMenu = $this->getFirstLevelMenuByGroupId($vGroup['id'], $authority['menuFunctionId']);
            $menu[$i]['children'] = $firstLevelMenu;
            $k = 0;
            foreach ($firstLevelMenu as $kSecondLevel => $vSecondLevel) {
                $secondLevelMenu = $this->getMenuListByParentId($vSecondLevel['id'], $authority['menuFunctionId']);
                $menu[$i]['children'][$k]['children'] = $secondLevelMenu;
                $l = 0;
                foreach ($secondLevelMenu as $kThirdLevel => $vThirdLevel) {
                    $thirdLevelMenu = $this->getMenuListByParentId($vThirdLevel['id'], $authority['menuFunctionId']);
                    $menu[$i]['children'][$k]['children'][$l]['children'] = $thirdLevelMenu;
                    $l ++;
                }
                $k ++;
            }
            $i++;
        }
        return $menu;
    }

    //当前用户的菜单
    public function menuAuthority($uid){       
        $authority = (new \backend\models\root\User)->userMenuAuthority($uid);
        return array('menuGroupId' => $authority[0], 'menuFunctionId' => $authority[1]);
    }

    //获取分组下的一级菜单
    private function getFirstLevelMenuByGroupId($groupid, $menuFunctionId){
        return $this->db->createCommand('select id, name, icon, controller, method, url from {{%function}} where groupid = :groupid and parent_id = 0 and status = 0 and id in('.$menuFunctionId.') order by sort desc', array('groupid' => $groupid))->queryAll();
    }

    //根据parent_id获取菜单树的list
    private function getMenuListByParentId($parent_id, $menuFunctionId){
        return $this->db->createCommand('select id, name, icon, controller, method, url from {{%function}} where parent_id = :parent_id and status = 0 and id in('.$menuFunctionId.') order by sort desc', array('parent_id' => $parent_id))->queryAll();
    }

    //判断当前路由是否加入权限控制
    public function curRouteInfo($controller, $method){
        return $this->db->createCommand('select id, status from {{%function}} where controller = :controller and method = :method', array('controller' => $controller, 'method' => $method))->queryOne();
    }
}