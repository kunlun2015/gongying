<?php
/**
 * 我的信息等
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-20 15:01:37
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class My extends CommonModel{

    public $uid;

    //修改登陆密码
    public function editPassword($newPassword){
        $data['encrypt'] = $this->randString(12);
        $data['password'] = md5(md5($newPassword).$data['encrypt']);
        return $this->db->createCommand()->update('{{%users}}', $data, array('id' => $this->uid))->execute();
    }

    //原密码信息
    public function checkOldPassword($oldPassword){
        $oldPasswordInfo = $this->db->createCommand('select password, encrypt from {{%root_user}} where id = :uid', array('uid' => $this->uid))->queryOne();
        return ($oldPasswordInfo['password'] === md5(md5($oldPassword).$oldPasswordInfo['encrypt'])) ? true : false;
    }

    //个人信息
    public function myInfo(){
        return $this->db->createCommand('select id, username, realname, sex, mobile, avatar, remarks, login_times, last_login_time, last_login_ip, status from {{%users}} where id = :uid', array('uid' => $this->uid))->queryOne();
    }

    //修改个人信息
    public function editMyInfo($data){
        return $this->db->createCommand()->update('{{%users}}', $data, array('id' => $this->uid))->execute();
    }

    //修改头像
    public function editAvatar($path){
        return $this->db->createCommand()->update('{{%users}}', array('avatar' => $path), array('id' => $this->uid))->execute();
    }

}