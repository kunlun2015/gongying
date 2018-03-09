<?php
/**
 * 详情页
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-09 18:06:08
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Published;

class DetailController extends AppController {
    
    public function actionIndex()
    {        
        return $this->render('index');
    }
}