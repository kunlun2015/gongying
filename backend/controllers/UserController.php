<?php
/**
 * 用户管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-21 16:40:35
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\User;
use yii\helpers\Url;

class UserController extends AdminController
{
    private $user;

    public function init()
    {
        parent::init();
        $this->user = new User;
    }
    
    //用户列表
    public function actionIndex()
    {
        $page = (int)$this->request->get('page') ? $this->request->get('page') : 1;
        $pageSize = 10;
        $username = $this->request->get('username');
        $data['list'] = $this->user->userList($username, $page, $pageSize, $totalPage);
        $data['pagination'] = '';
        return $this->render('index', $data);
    }

    public function actionEdit()
    {
        $suid = (int)$this->request->get('suid');
        $data['user'] = $this->user->getEditInfo($suid);
        return $this->render('edit', $data);
    }

    public function actionShow()
    {
        $suid = (int)$this->request->get('suid');
        $data['user'] = $this->user->userDetail($suid);
        return $this->render('show', $data);
    }

    public function actionSave()
    {
        if(!$this->request->isAjax || !$this->request->isPost){
            exit('不支持的访问');
        }
        $act = $this->request->post('act');
        switch ($act) {
            case 'update':
                $suid = (int)$this->request->post('suid');
                $data = [
                    'status' => (int)$this->request->post('status')  
                ];
                if($this->user->save($suid, $data)){
                    $this->jsonExit(0, '信息更新成功', ['url' => Url::to(['/user'])]);
                }else{
                    $this->jsonExit(-1, '信息没有被更新或者更新失败');
                }
                break;
            
            default:
                # code...
                break;
        }
    }
}