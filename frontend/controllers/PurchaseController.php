<?php
/**
 * 求购
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-03 11:34:54
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Published;

class PurchaseController extends AppController {

    private $pageSize = 10;
    public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
        $published = new Published;
        $type = 1;
        $data['keywords'] = $this->request->get('keywords');
        $fid = (int)$this->request->get('fid') ? $this->request->get('fid') : 0;
        $sid = (int)$this->request->get('sid') ? $this->request->get('sid') : 0;
        $tid = (int)$this->request->get('tid') ? $this->request->get('tid') : 0;
        $page = 1;
        $pageSize = $this->pageSize;
        $data['list'] = $published->dataList($type, $data['keywords'], $fid, $sid, $tid, $page, $pageSize, $data['totalPage']);
        return $this->render('index', $data);
    }

    public function actionGetData()
    {
        $published = new Published;
        $type = 1;
        $keywords = $this->request->post('keywords');
        $fid = 0;
        $page = intval($this->request->post('page')) ? intval($this->request->post('page')) : 1;
        $pageSize = $this->pageSize;
        $data['list'] = $published->dataList($type, $keywords, $fid, $page, $pageSize, $data['totalPage']);
        $this->jsonExit(0, '数据加载成功', $data['list']);
    }
}