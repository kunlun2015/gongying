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
        $data['detail'] = $this->published->detail($id); 
        return $this->render('index', $data);
    }
}