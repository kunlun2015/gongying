<?php
/**
 * 我的
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-22 17:47:22
 * @version 1.0
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class MyController extends AppController {

    public function actionIndex()
    {
        return $this->render('index');
    }
}