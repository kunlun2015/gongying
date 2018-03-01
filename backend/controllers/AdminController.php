<?php
/**
 * 后台管理员父类
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 13:37:59
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class AdminController extends CommonController{

    public function init(){
        parent::init();        
        $userMenuLevel = (new \backend\models\Login)->userAuthorityMenuLevel($this->session->get('user')['id']);
        Yii::$app->view->params['userMenuLevel'] = $userMenuLevel;    
    }

    //菜单权限判断
    public function beforeAction($action){
        //登录控制
        if(!$this->session->get('user')){
            return $this->redirect(Url::to(['/login'], true), 301);
        }
        $controller = Yii::$app->controller->id;
        $method     = Yii::$app->controller->action->id;
        $login = new \backend\models\Login;
        $router = $login->curRouteInfo($controller, $method);
        if($router){
            if($router['status'] == 0){
                $authority = $login->menuAuthority($this->session->get('user')['id']);
                $authorityFunction = explode(',', $authority['menuFunctionId']);
                if(!in_array($router['id'], $authorityFunction)){
                    exit('您没有权限使用此功能！');
                }
            }else{
                exit('菜单没有开放！');
            }
        }
        return parent::beforeAction($action);
    }

}