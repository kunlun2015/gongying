<?php
/**
 * console common model
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-23 10:30:04
 * @version $Id$
 */

namespace console\models;
use yii;
use yii\base\Model;

class CommonModel extends Model {

    protected $db;
    protected $app;
    protected $params;

    public function init(){
        $this->app = Yii::$app;
        $this->db = $this->app->db;        
        $this->params = $this->app->params;
    }
}