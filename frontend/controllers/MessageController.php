<?php
/**
 * 消息
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 22:00:11
 * @version 1.0
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\Message;

class MessageController extends AppController {

    private $user;
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        $this->user = $this->session->get('user');
    }

    public function actionIndex()
    {
        $message = new Message;
        $page = 1;
        $pageSize = 10;
        $data['user'] = $this->user;
        $data['list'] = $message->messageList($this->user['id'], $page, $pageSize, $totalPage);
        return $this->render('index', $data);
    }

    public function actionList()
    {
        $message = new Message;
        $page = (int)$this->request->get('page') ? (int)$this->request->get('page') : 1;
        $rid = (int)$this->request->get('rid');
        $pageSize = 10;
        $list = $message->messageDetail($rid, $page, $pageSize, $totalPage);
        $this->jsonExit(0, '数据获取成功', $list);
    }

    
    public function actionDetail()
    {   
        $toId = (int)$this->request->get('toId');
        $data['toUser'] = (new User)->userUInfoByUid($toId);
        if(!$data['toUser']){
            exit('用户不存在');
        }
        if($toId == $this->user['id']){
            return $this->tipsPage([
                'title' => '', 
                'msg' => '不能与自己对话哦', 
                'icon' => 'weui-icon-info',
                'redirect' => true,
                'autoRedirect' => true,
                'redirectUrl' => ''
            ]);
        }
        $data['user'] = $this->user;
        $message = new Message;
        $data['rid'] = $message->isHasMessaged($this->user['id'], $toId);
        $page = 1;
        $pageSize = 10;
        $data['message'] = [];
        if($data['rid']){
            $data['message'] = $message->messageDetail($data['rid'], $page, $pageSize, $data['totalPage']);
            $message->markMessageReaded($data['rid'], $this->user['id']);
            //删除模板消息发送标志，如果已查看则可发送模板消息通知否则在特定的时间内只发送一次
            $this->app->cache->get($data['rid'].'-'.$this->user['id']) && $this->app->cache->delete($data['rid'].'-'.$this->user['id']);
        }        
        return $this->render('detail', $data);
    }

    public function actionSend()
    {
        $time = date('Y-m-d H:i:s');
        $rid = (int)$this->request->post('rid');
        $data = [
            'message' => strip_tags($this->request->post('message')),
            'suid' => $this->user['id'],
            'to_suid' => $this->request->post('tuid'),
            'time' => $time
        ];
        $message = new Message;        
        if($rid = $message->insert($rid, $data)){
            $this->jsonExit(0, '消息发送成功', [
                'rid' => $rid,
                'message' => $data['message'], 
                'time' => $time
            ]);
        }else{
            $this->jsonExit(-1, '消息发送失败');
        }

    }
}