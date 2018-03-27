<?php
/**
 * 微信相关操作
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-12 17:50:04
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class Wx extends CommonModel
{
    private $appId;
    private $appSecret;
    protected $webAccessToken;
    private $curUrl;
    public $scope = 'snsapi_userinfo';
    private $code;
    private $openid;

    public function init(){
        parent::init();
        $this->appId = $this->app->params['wx']['appId'];
        $this->appSecret = $this->app->params['wx']['appSecret'];
        $this->curUrl = urlencode($this->app->request->absoluteUrl);
    }

    //授权获取用户信息
    public function userInfo()
    {
        $this->code = $this->app->request->get('code');
        if(!$this->code){
            $this->getCode();
        }
        $this->webAccessToken();        
        if($this->scope == 'snsapi_base'){
            return ['openid' => $this->openid];
        }else{
            return $this->userDetail();
        }

    }

    //获取code
    private function getCode(){
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appId.'&redirect_uri='.$this->curUrl.'&response_type=code&scope='.$this->scope.'&state=STATE#wechat_redirect';
        header("Location: $url");
        exit;
    }

    //获取网页授权access_token
    private function webAccessToken()
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appId.'&secret='.$this->appSecret.'&code='.$this->code.'&grant_type=authorization_code';
        $curl = new \linslin\yii2\curl\Curl;
        $response = $curl->get($url);
        $response = json_decode($response, true);
        if(isset($response['errcode'])){
            return $this->getCode();
        }
        $this->openid = $response['openid'];
        $this->webAccessToken = $response['access_token'];
    }

    //用户详情
    private function userDetail()
    {
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$this->webAccessToken.'&openid='.$this->openid.'&lang=zh_CN';
        $curl = new \linslin\yii2\curl\Curl;
        $response = $curl->get($url);
        return json_decode($response, true);
    }

    //基础access_token
    public function accessToken()
    {
        $accessToken = $this->app->cache->get($this->appId.'-accessToken');
        if($accessToken){
            return $accessToken;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appId.'&secret='.$this->appSecret;
        $curl = new \linslin\yii2\curl\Curl;
        $response = $curl->get($url);
        $response = json_decode($response, true);
        if(!isset($response['errcode'])){
            $this->app->cache->set($this->appId.'-accessToken', $response['access_token'], 7000);
            return $response['access_token'];
        }else{
            return $response;
        }
    }

    //jssdk签名信息
    public function getSignPackage() {
        $jsapiTicket = $this->jsApiTicket();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->randString(16);
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
          'appId'     => $this->appId,
          'nonceStr'  => $nonceStr,
          'timestamp' => $timestamp,
          'url'       => $url,
          'signature' => $signature,
          'rawString' => $string
        );
        return $signPackage; 
    }

    //获取jsapi_ticket
    public function jsApiTicket()
    {        
        $jsApiTicket = $this->app->cache->get($this->appId.'-jsApiTicket');
        if($jsApiTicket){
            return $jsApiTicket;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->accessToken().'&type=jsapi';
        $curl = new \linslin\yii2\curl\Curl;
        $response = $curl->get($url);
        $response = json_decode($response, true);
        if($response['errcode'] == 0){
            $this->app->cache->set($this->appId.'-jsApiTicket', $response['ticket'], 7000);
            return $response['ticket'];
        }else{
            return $response;
        }
    }

    /**
     * 发送模板消息
     * 发送成功返回消息id,失败返回false
     * @return mixed
     */
    public function sendTemplateMsg()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->accessToken();
        $curl = new \linslin\yii2\curl\Curl;
        $response = $curl->post($url, $data);
        $response = json_decode($response, true);
        if($response['errcode'] === 0){
            return $response['msgid'];
        }else{
            return false;
        }
    }
}