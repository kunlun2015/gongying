<?php
/**
 * 系统管理员父类
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 13:34:48
 * @version $Id$
 */

namespace backend\controllers\root;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class RootController extends \backend\controllers\CommonController{

    public $layout = 'root';
   
    //初始化
    public function init(){
        parent::init();
        if(!$this->session->get('root_session')){
            return $this->redirect(Url::to(['/root/login'], true), 301);
        }
    }

}