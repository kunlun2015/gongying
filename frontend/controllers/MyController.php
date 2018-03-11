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
use frontend\models\My;

class MyController extends AppController {

    private $user;
    private $my;

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

    public function actionPublished()
    {
        $pageSize = 10;
        if($this->request->isAjax && $this->request->isPost){
            $page = $this->request->post('page');
            $type = $this->request->post('type');
            $list = $this->my->published($this->user['suid'], $type, $page, $pageSize, $totalPage);
            $this->jsonExit(0, '数据加载成功', $list);

        }
        $data['purchaseList'] = $this->my->published($this->user['suid'], 1, 1, $pageSize, $data['purchaseTotalPage']);
        $data['supplyList'] = $this->my->published($this->user['suid'], 2, 1, $pageSize, $data['supplyTotalPage']);
        return $this->render('published', $data);
    }

    public function actionProfile()
    {
        $data['user'] = $this->user;
        return $this->render('profile', $data);
    }
}