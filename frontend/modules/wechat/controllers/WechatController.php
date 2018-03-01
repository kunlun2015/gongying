<?php
/**
 * 微信控制器父类
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-01-31 16:41:48
 * @version $Id$
 */

namespace app\modules\wechat\controllers;

use Yii;
use yii\web\Controller;
use common\models\Log;

class WechatController extends Controller
{

    protected $app;
    protected $log;
    protected $request;

    public function init()
    {   
        $this->app = Yii::$app;
        $this->request = $this->app->request;
        $this->log = new Log;
    }

    /**
     * 执行一些操作
     */
    public function beforeAction($action)
    {        
        return true;
    }
}