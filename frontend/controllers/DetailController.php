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
        $data['detail'] = $this->published->detail($id);
        $data['isCollected'] = $this->published->isCollected($suid, $id);
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
}