<?php
/**
 * 分类
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 21:56:49
 * @version 1.0
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class ClassifyController extends AppController {

    public function actionIndex()
    {
        return $this->render('index');
    }
}