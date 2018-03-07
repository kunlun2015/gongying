<?php
/**
 * 发布采购、供应
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-07 11:00:52
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Classify;

class PublishController extends AppController {
    
    public function actionIndex()
    {
        $type = $this->request->get('type');
        if(!$type){
            return $this->app->runAction('publish/type');
        }
        $classify = new Classify;
        $data['classify'] = $classify->classifyList();
        return $this->render('index', $data);
    }

    //发布类型选择
    public function actionType()
    {
        return $this->render('type');
    }

    public function actionSave()
    {
        $data = [
            'title' => $this->request->post('title'),
            'num' => $this->request->post('num'),
            'clssify_1' => $this->request->post('classify_1'),
            'clssify_2' => $this->request->post('classify_2'),
            'clssify_3' => $this->request->post('classify_3'),
            'budget' => $this->request->post('budget'),
            'delivery_cycle' => $this->request->post('delivery_cycle'),
            'deadline' => $this->request->post('deadline'),
            'description' => $this->request->post('description'),
            'anonymous' => $this->request->post('anonymous') ? $this->request->post('anonymous') : 0
        ];
    }
}