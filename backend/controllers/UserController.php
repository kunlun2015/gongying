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
        $suid = (int)$this->request->get($suid);
        
    }
}