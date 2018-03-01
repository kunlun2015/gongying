<?php
/**
 * 用户登录
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-06 14:50:10
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Login;
use yii\helpers\Url;

class LoginController extends CommonController{

    //登录页面
    public function actionIndex(){
        return $this->renderPartial('index');
    }

    //用户登录验证
    public function actionCheck(){      
        $username = trim($this->request->post('username'));
        $password = $this->request->post('password');
        $user_ip  = $this->request->userIP;
        $rst = (new Login)->loginCheck($username, $password, $user_ip);
        if($rst === -1){
            $this->jsonExit(-1, '用户名输入有误！');
        }elseif($rst === -2){
            $this->jsonExit(-2, '密码输入不正确！');
        }elseif($rst === true){
            $this->jsonExit(0, '登录成功！', array('url' => Url::to(['/site'])));
        }
    }

    //退出登录
    public function actionLogOut(){
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $this->session->remove('user');
        $this->jsonExit(0, '退出成功！', array('url' => Url::to(['/login'], true)));
    }

}