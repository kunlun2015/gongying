<?php
/**
 * cli模式控制器父类
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-23 10:22:42
 * @version $Id$
 */

namespace console\controllers;
use Yii;
use yii\console\Controller;

class ConsoleController extends Controller{
    
    protected $app;
    protected $params;

    public function init(){
        $this->app = Yii::$app;
        $this->params = Yii::$app->params;
    }

    public function beforeAction($action){
        parent::beforeAction($action);
        return true;
    }

}