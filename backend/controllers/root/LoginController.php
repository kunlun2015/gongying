<?php
/**
 * 登录
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-27 15:27:30
 * @version $Id$
 */

namespace backend\controllers\root;
use Yii;
use yii\web\Controller;
use yii\helpers\Url; 
use backend\models\root\RootLogin;

class LoginController extends \backend\controllers\CommonController{

    public function init(){
        parent::init();
    }

    //登录页面
    public function actionIndex(){
        return $this->renderPartial('login');
    }

    //退出登录
    public function actionOut(){
        $this->session->remove('root_session');
        $this->jsonExit(0, '退出成功！', array('url' => Url::to(['/root/login'], true)));
    }

    //登录校验
    public function actionCheck(){
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $model = new RootLogin;        
        $model->username = trim($this->request->post('username'));
        $model->password = $this->request->post('password');
        $model->last_login_ip   =  $this->request->userIP;
        $model->last_login_time = date('Y-m-d H:i:s');
        $rst = $model->loginValidate();
        if($rst == -1){
            $this->jsonExit(-1, '登录用户不存在！');
        }elseif($rst == -2){
            $this->jsonExit(-1, '登录密码不正确！');
        }elseif($rst == 0){
            $this->jsonExit(0, '登录成功！', array('url' => Url::to(['/root/site'], true)));
        }
    }

}