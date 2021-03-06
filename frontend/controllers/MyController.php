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
use yii\helpers\Url;
use frontend\models\My;
use frontend\models\User;
use common\models\Sms;

class MyController extends AppController {

    private $user;
    private $my;
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        $this->user = $this->session->get('user');
        $this->my = new My;
    }

    public function actionIndex()
    {
        $data['user'] = $this->user;
        return $this->render('index', $data);
    }

    //我的发布
    public function actionPublished()
    {
        $pageSize = 10;
        if($this->request->isAjax && $this->request->isPost){
            $page = $this->request->post('page');
            $type = $this->request->post('type');
            $list = $this->my->published($this->user['id'], $type, $page, $pageSize, $totalPage);
            $this->jsonExit(0, '数据加载成功', $list);

        }
        $data['purchaseList'] = $this->my->published($this->user['id'], 1, 1, $pageSize, $data['purchaseTotalPage']);
        $data['supplyList'] = $this->my->published($this->user['id'], 2, 1, $pageSize, $data['supplyTotalPage']);
        return $this->render('published', $data);
    }

    public function actionCollected()
    {
        $pageSize = 5;
        if($this->request->isAjax && $this->request->isPost){
            $page = $this->request->post('page');
            $type = $this->request->post('type');
            $list = $this->my->collected($this->user['id'], $type, $page, $pageSize, $data['totalPage']);
            $this->jsonExit(0, '数据加载成功', $list);

        }
        $data['purchaseList'] = $this->my->collected($this->user['id'], 1, 1, $pageSize, $data['purchaseTotalPage']);
        $data['supplyList'] = $this->my->collected($this->user['id'], 2, 1, $pageSize, $data['supplyTotalPage']);
        return $this->render('collected', $data);
    }

    //删除收藏
    public function actionDeleteCollected()
    {
        $id = $this->request->post('id');
        if($this->my->deleteCollected($this->user['id'], $id)){
            $this->jsonExit(0, '删除成功');
        }else{
            $this->jsonExit(-1, '删除失败，请稍后重试');
        }
    }

    public function actionProfile()
    {
        $data['user'] = $this->user;
        return $this->render('profile', $data);
    }

    //选择头像文件
    public function actionSelectAvatar()
    {
        return $this->render('selectAvatar');
    }

    //绑定手机号码
    public function actionBindMobile()
    {
        if($this->request->isAjax && $this->request->isPost){
            $mobile = $this->request->post('mobile');
            $code = $this->request->post('code');
            //验证验证码是否正确
            (new Sms)->checkCode('common', $mobile, $code);
            if($this->my->update($this->user['id'], ['mobile' => $mobile])){
                $this->user['mobile'] = $mobile;
                $this->session->set('user', $this->user);
                $this->jsonExit(0, '已成功绑定手机号码', ['url' => Url::to(['/my/profile'])]);
            }else{
                $this->jsonExit(-1, '手机号码解绑失败，请稍后重试');
            }
        }
        $mobile = $this->user['mobile'];
        $data['backUrl'] = $this->request->get('backUrl');
        return $mobile ? $this->app->runAction('/my/unbind-mobile') : $this->render('bindMobile', $data);
    }

    public function actionUnbindMobile()
    {
        if($this->request->isAjax && $this->request->isPost){
            $mobile = $this->request->post('mobile');
            $code = $this->request->post('code');
            //验证验证码是否正确
            (new Sms)->checkCode('common', $mobile, $code);
            if($this->my->update($this->user['id'], ['mobile' => ''])){
                $this->user['mobile'] = '';
                $this->session->set('user', $this->user);
                $this->jsonExit(0, '已解绑手机号码，请重新绑定手机号码', ['url' => Url::to(['/my/bind-mobile'])]);
            }else{
                $this->jsonExit(-1, '手机号码解绑失败，请稍后重试');
            }
        }
        $mobile = $this->user['mobile'];
        return $this->render('unBindMobile', ['mobile' => $mobile]);
    }

    public function actionEditProfile()
    {
        if($this->request->isAjax && $this->request->isPost){
            $data = [
                'username' => $this->request->post('username'),
                'company'  => $this->request->post('company'),
                'position' => $this->request->post('position')
            ];
            if($this->my->update($this->user['id'], $data)){
                $userInfo = (new User)->detailByOpenId($this->user['openid']);
                $this->session->set('user', $userInfo);
                $this->jsonExit(0, '资料更新成功', ['url' => '/my/profile']);
            }else{
                $this->jsonExit(-1, '资料更新失败');
            }
        }
        $data['user'] = $this->my->getEditInfo($this->user['id']);
        $data['backUrl'] = $this->request->get('backUrl');
        return $this->render('editProfile', $data);
    }

    //保存头像文件
    public function actionSaveAvatar()
    {
        $base64 = $this->request->post('base64');
        $upload = new \common\models\Upload;
        $upload->saveDir = 'avatar';
        $rst = $upload->saveBase64Img($base64);
        if($rst['code'] === 0 && $this->my->update($this->user['id'], ['avatar' => $rst['path']])){
            $this->user['avatar'] = $rst['path'];
            $this->session->set('user', $this->user);
            $this->jsonExit(0, '头像保存成功', ['url' => '/my/profile']);
        }else{
            $this->jsonExit(-1, '头像保存失败');
        }
    }
}