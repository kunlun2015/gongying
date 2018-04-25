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
use Qcloud\Sms\SmsSingleSender;

class SendSmsController extends AppController {

    public function actionBindMobile()
    {
        $appid = 1400087307;
        $appkey = '3bfe70fe99fac13040ff193559e89ac5';
        $templateId = 141087;
        $phoneNumber = 18656706251;
        $smsSign = '';
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = ["5678"];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId, $params, $smsSign, "", "");
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
    }
}