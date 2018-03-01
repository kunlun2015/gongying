<?php
/**
 * 当前用户信息管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 15:09:23
 * @version $Id$
 */

namespace backend\controllers\root;
use Yii;
use yii\web\Controller;

class MyController extends RootController{

    //初始化
    public function init(){
        parent::init();
    }

    //用户信息展示
    public function actionIndex(){
        return $this->render('index');
    }

    //保存用户信息
    public function actionSave(){
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $act = $this->request->post('act');
        switch ($act) {
            case 'password':
                $password     = $this->request->post('password');
                $password_old = $this->request->post('password_old');
                //校验原密码是否正确
                $password_info = $this->db->createCommand('select password, encrypt from {{%root_user}} where id = '.$this->session->get('root_session')['id'])->queryOne();
                if(md5(md5($password_old).$password_info['encrypt']) != $password_info['password']){
                    $this->jsonExit(-1, '原密码输入不正确！');
                }
                $data['encrypt']  = $this->randString(8);
                $data['password'] = md5(md5($password).$data['encrypt']);
                $rst = $this->db->createCommand()->update('{{%root_user}}', $data, 'id = '.$this->session->get('root_session')['id'])
                   ->execute();
                if($rst){
                    $this->jsonExit(0, '数据保存成功！');
                }else{
                    $this->jsonExit(-1, '数据保存失败，请稍后重试！');
                }
                break;
            
            default:
                
                break;
        }
    }

}