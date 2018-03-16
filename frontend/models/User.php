<?php
/**
 * 用户信息
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-12 16:32:59
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class User extends CommonModel
{
   
   /**
    * 根据openid获取用户信息
    * @param  string $openid 微信openid
    * @return array
    */
    public function detailByOpenId($openid)
    {
       return $this->db->createCommand('select id, openid, username, sex, mobile, company, position, avatar, status from {{%site_users}} where openid = :openid', ['openid' => $openid])->queryOne();
    }


    public function insert($data)
    {
        return $this->db->createCommand()->insert('{{%site_users}}', $data)->execute();
    }

    /**
     * 查询用户是否存在，并返回用户信息
     * @param  int  $suid
     * @return boolean/array
     */
    public function userUInfoByUid($suid){
        return $this->db->createCommand('select id, openid, username, avatar from {{%site_users}} where id = :suid', ['suid' => $suid])->queryOne();
    }

}