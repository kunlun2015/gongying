<?php
/**
 * 对接腾信短信接口
 * @authors Amos (735767227@qq.com)
 * @date    2018-04-28 10:28:56
 * @version $Id$
 */

namespace common\models;
use yii\base\Model;
use yii;
use Qcloud\Sms\SmsSingleSender;

class Sms extends CommonModel{

    const TIME_LIMIT = 30;

    /**
     * 短信通用模板发送
     * @param  int $phoneNumber 手机号码
     * @return json
     */
    public function common($phoneNumber)
    {
        $smsConfig = Yii::$app->params['sms'];
        $template = $smsConfig['template']['common'];
        $templateId = $template['templateId'];
        $smsSign = '';
        try {
            $ssender = new SmsSingleSender($smsConfig['appid'], $smsConfig['appkey']);
            $verifyCode = $this->randString(6, 2);
            $params = [$verifyCode, $template['expiry']];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId, $params, $smsSign, "", "");
            $rsp = json_decode($result);
            if($rsp && $rsp->result == 0){
                Yii::$app->cache->set('sms-common-'.$phoneNumber, $verifyCode, $template['expiry']);
                Yii::$app->cache->set('sms-limit-common-'.$phoneNumber, 1, self::TIME_LIMIT);
                return $this->jsonExit(0, '短信发送成功');
            }else{
                return $this->jsonExit(-1, $rsp->errmsg);
            }
        } catch(\Exception $e) {
            return $this->jsonExit(-1, '短信接口异常');
        }
    }

    /**
     * 校验短信验证码
     * @param  string $templateName 模板名称
     * @param  int $mobile          手机号码
     * @param  int $code            验证码
     * @return json
     */
    public function checkCode($templateName, $mobile, $code)
    {
        $cacheCode = Yii::$app->cache->get('sms-'.$templateName.'-'.$mobile);
        if(!$cacheCode || $code != $cacheCode){
            return $this->jsonExit(-1, '验证码不正确或已过期');
        }
    }

    /**
     * 发送频率限制
     * @param  string $templateName 模板名称
     * @param  int $mobile          手机号码
     * @return json
     */
    private function sendLimit($templateName, $mobile)
    {
        if(Yii::$app->cache->get('sms-limit-'.$templateName.'-'.$mobile)){
            return $this->jsonExit(-1, '频率限制，请稍后再试');
        }
    }

}