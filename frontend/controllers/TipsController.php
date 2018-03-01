<?php
/**
 * 提示页
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-08-31 16:32:37
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class TipsController extends AppController {

    //参数错误提示页面
    public function actionIndex(array $params)
    {
        return $this->render('index', $params);
    }
    
    //404提示页面
    public function action404(array $params)
    {
        return $this->render('404', $params);
    }

    //500提示页面
    public function action500(array $params)
    {
        return $this->render('500', $params);
    }
}
