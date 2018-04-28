<?php
/**
 * 发送短信验证码
 * @authors Amos (735767227@qq.com)
 * @date    2018-04-25 16:08:48
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use common\models\Sms;

class SendSmsController extends AppController {

    public function actionBindMobile()
    {
        $phoneNumber = $this->request->post('mobile');
        $sms = new Sms;
        return $sms->common($phoneNumber);
    }
}