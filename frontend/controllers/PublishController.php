<?php
/**
 * 发布采购、供应
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-07 11:00:52
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class PublishController extends AppController {
    
    public function actionIndex()
    {
        $type = $this->request->get('type');
        if(!$type){
            return $this->app->runAction('publish/type');
        }
        return $this->render('index');
    }

    //发布类型选择
    public function actionType()
    {
        return $this->render('type');
    }
}