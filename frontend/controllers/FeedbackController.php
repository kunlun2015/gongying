<?php
/**
 * 反馈
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 18:03:31
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Feedback;

class FeedbackController extends AppController {

    public function actionIndex()
    {
        $data = [];
        return $this->render('index', $data);
    }

}