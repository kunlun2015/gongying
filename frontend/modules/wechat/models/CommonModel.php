<?php
/**
 * 微信model父类
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-01 10:25:10
 * @version $Id$
 */

namespace app\modules\wechat\models;
use yii;
use yii\base\Model;

class CommonModel extends \common\models\CommonModel
{
    protected $db;
    protected $params;

    public function init()
    {
        $this->db = Yii::$app->db;
        $this->params = Yii::$app->params;
    }
}