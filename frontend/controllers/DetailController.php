<?php
/**
 * 详情页
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-09 18:06:08
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Published;
use frontend\models\Wx;

class DetailController extends AppController {

    private $published;

    public function init()
    {
        parent::init();
        $this->published = new Published;
    }
    
    public function actionIndex()
    {      
        $id = $this->request->get('id');
        $suid = $this->session->get('user')['id'];
        $data['isBindMObile'] = $this->session->get('user')['mobile'] ? 1 : 0;
        $data['detail'] = $this->published->detail($id);
        $previewImgUrls = array_map(function($url){
            return $this->app->params['imgUrl'].$url;
        }, $data['detail']['pictures']);
        $data['previewImgUrls'] = $previewImgUrls;
        $data['isCollected'] = $this->published->isCollected($suid, $id);
        $data['singPackage'] = (new Wx)->getSignPackage();
        return $this->render('index', $data);
    }

    /**
     * 收藏/取消收藏
     * @return json
     */
    public function actionCollect()
    {
        $pid = $this->request->post('pid');
        $suid = $this->session->get('user')['id'];
        if(!$this->published->isCollected($suid, $pid)){
            if($this->published->collect($suid, $pid)){
                $this->jsonExit(0, '收藏成功', ['status' => 1]);
            }else{
                $this->jsonExit(-1, '收藏失败，请稍后重试');
            }
        }else{
            if($this->published->deleteCollected($suid, $pid)){
                $this->jsonExit(0, '已取消收藏', ['status' => 0]);
            }else{
                $this->jsonExit(-1, '取消收藏失败，请稍后重试');
            }
        }
    }

    public function actionGetMobile()
    {
        $uid = $this->request->get('uid');
        $mobile = $this->published->getMobileByUid($uid);
        if($mobile){
            $this->jsonExit(0, '手机号码获取成功', ['mobile' => $mobile]);
        }else{
            $this->jsonExit(-1, '手机号码获取失败');
        }
    }
}