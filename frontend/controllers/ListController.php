<?php
/**
 * 发布列表
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-02 17:06:50
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class ListController extends AppController {
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}