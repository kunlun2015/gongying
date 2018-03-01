<?php
/**
 * 微信api
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-01-31 16:46:57
 * @version $Id$
 */

namespace app\modules\wechat\controllers;

use yii\web\Controller;
use app\modules\wechat\models\Wechat;

class ApiController extends WechatController
{

    private $wechat;
    private $signature;
    private $token;
    private $data = [];

    public function init()
    {
        parent::init();
        $this->wechat = new Wechat;
        
    }

    public function beforeAction($action)
    {
        //接收签名参数
        $this->signature = [
            'signature' => $this->request->get('signature'),
            'echostr' => $this->request->get('echostr'),
            'timestamp' => $this->request->get('timestamp'),
            'nonce' => $this->request->get('nonce')
        ];
        //验证账号信息
        $id = $this->request->get('id');
        $account = $this->wechat->getAccount($id);
        if(!$account){
            exit('账号不存在');
        }
        $this->token =md5($account['id'].$account['appid'].'kunlun');
        return true;
    }

    /**
     * 微信消息接口
     * 
     */
    public function actionIndex()
    {
        if($this->request->isGet){
            $this->accountAccess();
        }elseif($this->request->isPost){
            //验证签名
            $this->checkSignature();
            //解析微信消息数据
            $xmlData = file_get_contents('php://input');
            $this->data = $this->wechat->xmlToArray($xmlData);
            $this->log->debug($xmlData);
            $this->log->debug($this->data);
            //处理消息逻辑
            $this->msgAction();
        }
    }

    /**
     * 微信账号接入
     * @return [type] [description]
     */
    private function accountAccess()
    {  
        $rst = $this->wechat->checkSignature($this->signature, $this->token);
        if($rst === true){
            exit($this->signature['echostr']);
        }else{
            exit('access failed');
        }
    }

    private function msgAction()
    {
        //回复关键字
        $this->replyKeywords();

        $msg = 'ok';
        $msgType = 'text';        
        $this->reply($msg, $msgType);
    }

    //回复关键字处理
    private function replyKeywords()
    {

    }

    /**
     * 验证签名
     * 验证失败则退出
     */
    private function checkSignature()
    {
        $rst = $this->wechat->checkSignature($this->signature, $this->token);
        if($rst != true){
            exit('signature checked failed');
        }
    }

    /**
     * 获取解析后的微信消息数据
     * @return array
     */
    private function wechatData()
    {
        return $this->data;
    }

    private function reply($msg, $msgType)
    {
        $msg = [
            'ToUserName' => $this->data['FromUserName'],
            'FromUserName' => $this->data['ToUserName'],
            'CreateTime' => time(),
            'MsgType' => $msgType,
            'Content' => $msg
        ];
        $xmlStr = $this->wechat->arrayToXml($msg);        
        echo $xmlStr;
    }

}