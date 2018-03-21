<?php
/**
 * 展示页面
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-21 15:57:43
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class DisplayController extends AppController {
    
    public function actionAboutUs()
    {
        return $this->render('aboutUs');
    }
}