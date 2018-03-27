<?php
/**
 * 反馈
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 18:03:31
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\Feedback;

class FeedbackController extends AppController {

    private $user;
    private $feedback;

    public function init()
    {
        parent::init();
        $this->user = $this->session->get('user');
        $this->feedback = new Feedback;
    }

    public function actionIndex()
    {
        $page = 1;
        $pageSize = 10;
        $data['list'] = $this->feedback->list($this->user['id'], $page, $pageSize, $totalPage);
        return $this->render('index', $data);
    }

    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionSave()
    {
        if(!$this->request->isAjax || !$this->request->isPost){
            exit('method not support');
        }
        $data = [
            'suid' => $this->user['id'],
            'content' => strip_tags($this->request->post('content'))
        ];
        if($this->feedback->save($data)){
            $this->jsonExit(0, '反馈已提交等待处理', ['url' => Url::to('/feedback')]);
        }else{
            $this->jsonExit(-1, '提交失败，请稍后重试');
        }
    }

}