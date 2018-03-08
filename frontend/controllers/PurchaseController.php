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
    
    public function actionIndex()
    {
        $published = new Published;
        $type = 1;
        $keywords = $this->request->get('keywords');
        $fid = 0;
        $page = 1;
        $pageSize = $this->pageSize;
        $data['list'] = $published->dataList($type, $keywords, $fid, $page, $pageSize, $totalPage);
        return $this->render('index', $data);
    }
}