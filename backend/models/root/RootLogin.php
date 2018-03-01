<?php
/**
 * root login
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 09:55:02
 * @version $Id$
 */

namespace backend\models\root;
use yii\base\Model;

class RootLogin extends \backend\models\CommonModel{

    public $username;
    public $password;
    public $last_login_ip;
    public $last_login_time;
    private $user;

    //登录验证
    public function loginValidate(){
        if(!($this->user = $this->userValidate())){
            return -1;//用户不存在
        }else{
            if(!$this->verifyPassword($this->password, $this->user['password'], $this->user['encrypt'])){
                return -2;//密码错误
            }else{
                $this->loginSuccess();
                return 0;
            }
        }
    }

    //验证用户
    private function userValidate(){
        return $this->db->createCommand("select id, username, avatar, password, encrypt, login_times, last_login_time, last_login_ip from {{%root_user}} where username = '{$this->username}'")->queryOne();
    }

    //登录成功
    private function loginSuccess(){
        $this->db->createCommand("update {{%root_user}} set login_times = login_times + 1, last_login_ip = '{$this->last_login_ip}', last_login_time = '{$this->last_login_time}'  where id = {$this->user['id']}")->execute();
        $this->session->set('root_session', $this->user);
    }
}