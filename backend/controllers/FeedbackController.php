<?php
/**
 * 反馈管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 10:35:50
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Feedback;
use yii\helpers\Url;

class FeedbackController extends AdminController
{
    private $feedback;

    public function init()
    {
        parent::init();
        $this->feedback = new Feedback;
    }

    public function actionIndex()
    {
        $status = $this->request->get('status');
        $page = (int)$this->request->get('page') ? (int)$this->request->get('page') : 1;
        $pageSize = 10;
        $data['list'] = $this->feedback->list($status, $page, $pageSize, $totalPage);
        $data['pagination'] = $this->feedback->pagination($totalPage, $page, Url::to(['/feedback', 'page' => 'PAGENUMPLACEHOLDER']), 10);
        return $this->render('index', $data);
    }

    public function actionReply()
    {
        if($this->request->isAjax && $this->request->isPost){
            $id = (int)$this->request->post('id');
            $data = [                
                'reply' => strip_tags($this->request->post('reply')),
                'replied_at' => date('Y-m-d H:i:s'),
                'status' => 1
            ];
            if($this->feedback->update($id, $data)){
                $this->jsonExit(0, '回复成功');
            }else{
                $this->jsonExit(-1, '回复失败，请稍后重试');
            }
        }
        $id = (int)$this->request->get('id');
        echo ip2long($this->request->userIP);
        $data['detail'] = $this->feedback->detail($id);
        return $this->render('reply', $data);
    }

}