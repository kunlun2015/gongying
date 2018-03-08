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

    private $user;

    public function init()
    {
        parent::init();
        $this->user = $this->session->get('user');
    }

    public function actionIndex()
    {
        $data['user'] = $this->user;
        return $this->render('index', $data);
    }

    public function actionProfile()
    {
        $data['user'] = $this->user;
        return $this->render('profile', $data);
    }
}