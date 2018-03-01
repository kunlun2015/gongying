<?php
/**
 * 
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-01-31 15:42:42
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use backend\models\Wechat;

class WechatController extends AdminController
{

    private $wechat;

    public function init()
    {
        parent::init();
        $this->wechat = new Wechat;
    }

    //微信账号管理列表页面
    public function actionAccount()
    {
        $page = intval($this->request->get('page')) ? intval($this->request->get('page')) : 1;
        $pageSize = 10;
        $data['list'] = $this->wechat->accountList($page, $pageSize);
        return $this->render('account', $data);
    }

    //添加微信账号
    public function actionAccountAdd()
    {
        return $this->render('accountAdd');
    }

    //编辑微信账号
    public function actionAccountEdit()
    {
        $id = $this->request->get('id');
        $data['detail'] = $this->wechat->getAccount($id);
        return $this->render('accountEdit', $data);
    }

    //查看账号接入信息
    public function actionAccountAccessInfo()
    {
        $id = $this->request->get('id');
        $data['detail'] = $this->wechat->getAccount($id);
        $data['token'] = md5($data['detail']['id'].$data['detail']['appid'].'kunlun');
        return $this->render('accountAccess', $data);
    }

    //回复关键字列表
    public function actionReplyKeywords()
    {
        $data = [];
        return $this->render('replyKeywords', $data);
    }

    //保存回复关键字
    public function actionReplyKeywordsSave()
    {
        $data = [];
        $data['account'] = $this->wechat->accountList(1, 10);
        return $this->render('replyKeywordsSave', $data);
    }

    //用户操作
    public function actionAction()    {

        $act = $this->request->post('act');        
        switch ($act) {
            case 'addAccount':
                $data = [
                    'name' => $this->request->post('name'),
                    'wx_id' => $this->request->post('wx_id'),
                    'appID' => $this->request->post('appID'),
                    'appsecret' => $this->request->post('appsecret'),
                    'remarks' => $this->request->post('remarks')
                ];
                if($this->wechat->addAccount($data)){
                    $this->jsonExit(0, '微信账号添加成功', ['url' => Url::to(['/wechat/account'])]);
                }else{
                    $this->jsonExit(-1, '添加失败，请重试！');
                }

                break;

            case 'editAccount':
                $data = [
                    'name' => $this->request->post('name'),
                    'wx_id' => $this->request->post('wx_id'),
                    'appID' => $this->request->post('appID'),
                    'appsecret' => $this->request->post('appsecret'),
                    'remarks' => $this->request->post('remarks')
                ];
                $id = $this->request->post('id');
                if($this->wechat->editAccount($id, $data)){
                    $this->jsonExit(0, '信息更新成功', ['url' => Url::to(['/wechat/account'])]);
                }else{
                    $this->jsonExit(-1, '更新失败，请重试！');
                }

                break;
            
            default:
                # code...
                break;
        }
    }
}