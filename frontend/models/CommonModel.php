<?php
/**
 * 前台model
 * @authors: Amos (735767227@qq.com)
 * @date: 2017-08-15 12:48
 * @version $Id$
 */
namespace frontend\models;
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

    //获取总页数
    protected function getTotalPage($sql, $pageSize){
        $rst = $this->db->createCommand($sql)->queryOne();
        return ceil($rst['count(*)']/$pageSize);
    }
}