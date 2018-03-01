<?php
/**
 * 后台控制器
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 10:52:19
 * @version $Id$
 */
namespace backend\controllers;
use Yii;
use yii\web\Controller;

class SiteController extends AdminController{

    //首页
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionTest(){
        echo 'ok';
    }


}
