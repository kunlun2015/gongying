<?php
/**
 * 用户管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 14:01:50
 * @version $Id$
 */

namespace backend\controllers\root;
use Yii;
use yii\web\Controller;
use backend\models\root\User;
use yii\helpers\Url;

class UserController extends RootController{

    private $page_size = 10;

    //初始化
    public function init(){
        parent::init();
    }

    //用户管理
    public function actionIndex(){
        $page = intval($this->request->get('page', 1));
        $model = new User;
        $data['list'] = $model->userList($this->page_size, $page, $total_page);
        return $this->render('index', $data);
    }

    //用户添加
    public function actionAdd(){
        return $this->render('add');
    }

    //编辑用户
    public function actionEdit(){
        $uid = $this->request->get('uid', 0);
        $data['user_info'] = (new User)->getEditUser($uid);
        if(!$data['user_info']){
            exit('没有该用户！');
        }
        return $this->render('edit', $data);
    }

    //用户权限
    public function actionAuthority(){
        $data['uid'] = $this->request->get('uid', 0);
        $menuTree = (new User)->menuLevelTree();
        $data['menuTree'] = json_encode($menuTree);
        //当前用户菜单权限
        $authority = (new User)->userMenuAuthority($data['uid']);
        $data['authority'] = isset($authority[2]) ? json_encode(explode(',', $authority[2])) : '';
        return $this->render('authority', $data);
    }

    //用户操作
    public function actionAction(){
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $act = $this->request->post('act');
        switch ($act) {
            case 'add':
                $data = array(
                    'username' => trim($this->request->post('username')),
                    'mobile'   => $this->request->post('mobile'),
                    'password' => trim($this->request->post('password')),
                    'remarks'   => $this->request->post('remarks')
                    );
                $model = new User;
                $rst = $model->addUser($data);
                if($rst){
                    $this->jsonExit(0, '用户添加成功！', array('url' => Url::to(['root/user'])));
                }else{
                    $this->jsonExit(-1, '用户添加失败，请稍候重试！');
                }
                break;

            case 'edit':
                $data = array(
                        'id'       => $this->request->post('uid'),
                        'realname' => $this->request->post('realname'),
                        'mobile'   => $this->request->post('mobile'),
                        'remarks'  => $this->request->post('remarks'),
                        'status'   => $this->request->post('status')
                    );
                $rst = (new User)->editUser($data);
                if($rst == 1){
                    $this->jsonExit(0, '用户修改成功！', array('url' => Url::to(['root/user'])));
                }else{
                    $this->jsonExit(-1, '用户信息没有被修改！');
                }
                break;

            case 'authority':                
                    $menuGroup    = $this->request->post('menuGroup');
                    $menuFunction = $this->request->post('menuFunction');
                    $treeCheckedState = $this->request->post('treeState');
                    $authority = $menuGroup.'|'.$menuFunction.'|'.$treeCheckedState;
                    $rst = (new User)->updateUserMenuAuthority($this->request->post('uid'), $authority);
                    if($rst){
                        $this->jsonExit(0, '用户权限修改成功！', array('url' => Url::to(['root/user'])));
                    }else{
                        $this->jsonExit(-1, '用户权限信息没有被修改！');
                    }
                break;
            
            default:
                # code...
                break;
        }
    }

}