<?php
/**
 * 消息
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 22:00:11
 * @version 1.0
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class MessageController extends AppController {

    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function actionDetail()
    {
        return $this->render('detail');
    }
}