<?php
/**
 * 首页
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-01-29 14:54:00
 * @version $Id$
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Banner;

class SiteController extends AppController {
    
    public function actionIndex()
    {
        $data['bannerList'] = (new Banner)->bannerList();
        return $this->render('index', $data);
    }

    public function actionTest()
    {
        echo 'test';
    }
}