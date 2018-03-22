<?php
/**
 * 发布列表
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-02 17:06:50
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Published;

class ListController extends AppController {

    private $published;
    private $pageSize = 10;
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        $this->published = new Published;
    }
    
    public function actionIndex()
    {
        $data['keywords'] = $this->request->get('keywords');
        $data['fid'] = (int)$this->request->get('fid') ? $this->request->get('fid') : 0;
        $data['sid'] = (int)$this->request->get('sid') ? $this->request->get('sid') : 0;
        $data['tid'] = (int)$this->request->get('tid') ? $this->request->get('tid') : 0;
        $page = 1;
        $pageSize = $this->pageSize;
        $data['purchaseList'] = $this->published->dataList(1, $data['keywords'], $data['fid'], $data['sid'], $data['tid'], $page, $pageSize, $data['purchaseTotalPage']);
        $data['supplyList'] = $this->published->dataList(2, $data['keywords'], $data['fid'], $data['sid'], $data['tid'], $page, $pageSize, $data['supplyTotalPage']);
        return $this->render('index', $data);
    }

    public function actionGetData()
    {
        $keywords = $this->request->post('keywords');
        $fid = (int)$this->request->post('fid') ? $this->request->post('fid') : 0;
        $sid = (int)$this->request->post('sid') ? $this->request->post('sid') : 0;
        $tid = (int)$this->request->post('tid') ? $this->request->post('tid') : 0;
        $page = intval($this->request->post('page')) ? intval($this->request->post('page')) : 1;
        $type = intval($this->request->post('type'));
        $pageSize = $this->pageSize;
        $data['list'] = $this->published->dataList($type, $keywords, $fid, $sid, $tid, $page, $pageSize, $totalPage);
        $this->jsonExit(0, '数据加载成功', $data['list']);
    }
}