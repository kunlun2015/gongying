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

    public function init()
    {
        parent::init();
        $this->published = new Published;
    }
    
    public function actionIndex()
    {
        $data['keywords'] = $this->request->get('keywords');
        $fid = 0;
        $page = 1;
        $pageSize = $this->pageSize;
        $data['purchaseList'] = $this->published->dataList(1, $data['keywords'], $fid, $page, $pageSize, $data['purchaseTotalPage']);
        $data['supplyList'] = $this->published->dataList(2, $data['keywords'], $fid, $page, $pageSize, $data['supplyTotalPage']);
        return $this->render('index', $data);
    }

    public function actionGetData()
    {
        $keywords = $this->request->post('keywords');
        $fid = 0;
        $page = intval($this->request->post('page')) ? intval($this->request->post('page')) : 1;
        $type = intval($this->request->post('type'));
        $pageSize = $this->pageSize;
        $data['list'] = $this->published->dataList($type, $keywords, $fid, $page, $pageSize, $totalPage);
        $this->jsonExit(0, '数据加载成功', $data['list']);
    }
}