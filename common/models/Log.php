<?php
/**
 * log 日志
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-01 16:46:34
 * @version $Id$
 */

namespace common\models;
use yii;
use yii\base\Model;

class Log extends CommonModel
{
    private $logRootPath;
    private $logFilePath;
    private $logFileName;
    private $logData;

    public function init()
    {
        
    }

    /**
     * debug模式下日志记录
     * 非debug模式下不记录
     */
    public function debug($data)
    {  
        $this->logData = $data;
        YII_DEBUG && $this->write();
    }

    /**
     * 记录信息
     */
    public function info($data)
    {
        $this->logData = $data;
        $this->write();
    }

    /**
     * 写入日志
     */
    private function write()
    {
        //初始化操作
        $this->logRootPath = Yii::$app->params['logRootPath'].Yii::$app->controller->module->id.'/';
        $this->logFilePath = date('Ym').'/';
        $this->logFileName = date('d').'.log';
        $this->checkDir($this->logRootPath.$this->logFilePath);

        $logInfo = [
            'time' => date('Y-m-d H:i:s'),
            'ip' => (new \yii\web\Request)->userIP,
            'route' => Yii::$app->controller->id.'/'.Yii::$app->controller->action->id,
            'msg' => $this->logData
        ];
        file_put_contents($this->logRootPath.$this->logFilePath.$this->logFileName, json_encode($logInfo)."\r\n", FILE_APPEND);
    }
}