<?php
/**
 * 前台控制器父类
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-13 17:28:28
 * @version $Id$
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Log;
use frontend\models\Wx;
use frontend\models\User;
use yii\db\Expression;

class AppController extends Controller {
    
    protected $app;
    protected $request;
    protected $log;
    protected $session;

    public function init(){
        $this->app = Yii::$app;
        $this->app->language = 'zh_CN';
        $this->request = $this->app->request;
        $this->session = $this->app->session;
        $this->loginControl();        
    }

    //异常提示处理
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        var_dump($exception);
        if($exception && isset($exception->statusCode) && $exception->statusCode === 404){
            return $this->tipsPage(['errMsg' => '页面找不到了'], '404');
        }else{
            return $this->tipsPage(['errMsg' => '服务器出错了'], '500');
        }
    }

    /**
     * 执行一些操作
     */
    public function beforeAction($action)
    {
        $this->log = new Log;
        $this->loginControl();
        return parent::beforeAction($action);
    }

    //未登录则微信授权登陆并存储session
    private function loginControl()
    {
        $this->session->set('user', [
            'id' => 1,
            'openid' => 'sdfgfg',
            'username' => 'Amos',
            'avatar' => 'avatar/2018/03/3J9na83TIzrE20180316101442.jpeg',
            'mobile' => '18656706251',
            'company' => 'sdrg'
        ]);
        if(!$this->session->get('user')){
            $user = new User;
            $wxUserInfo = (new Wx)->userInfo();
            $userInfo = $user->detailByOpenId($wxUserInfo['openid']);
            if(!$userInfo){
                if(!$user->insert([
                    'openid' => $wxUserInfo['openid'],
                    'username' => $wxUserInfo['nickname'],
                    'avatar' => 'avatar/2018/03/avatar.jpg',
                    'last_login_time' => date('Y-m-d H:i:s'),
                    'last_login_ip' => ip2long($this->request->userIP)
                ])){
                  exit('用户信息存储失败！');
                }
                $userInfo = $user->detailByOpenId($wxUserInfo['openid']);
                $this->session->set('user', $userInfo);
            }else{
                $user->update($userInfo['id'], [
                    'login_times' => new Expression('login_times+ 1'),
                    'last_login_time' => date('Y-m-d H:i:s'),
                    'last_login_ip' => ip2long($this->request->userIP)
                ]);
                $this->session->set('user', $userInfo);
            }
        }
    }

    //json数据返回
    protected function jsonExit($code, $msg, $data = array()){
        $return = array('code' => $code, 'msg' => $msg, 'data' => $data);
        exit(json_encode($return));
    }

    /**
     * 展示提示信息页面
     * @param array $params
     * @param string $type 默认index 提示信息, 404:404页面，500:500页面
     * @param tips page
     */
    protected function tipsPage($params = [], $type = 'index')
    {
        return $this->app->runAction('tips/'.$type, ['params' => $params]);
    }

}