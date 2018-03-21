<?php
/**
 * upload
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-05 13:46:55
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use Grafika\Grafika;

class UploadController extends AppController {
    
    public function actionToken()
    {
        $file['name'] = $_GET['name'];
        $file['size'] = $_GET['size'];
        $file['up_size'] = 0;
        $file['token'] = md5(json_encode($file['name'] . $file['size']));
        $pathInfo = pathinfo($file['name']);
        $savePath = 'published/'.date('Y').'/'.date('m').'/';
        $file['filePath'] = 'published/'.date('Y').'/'.date('m').'/'.$file['token'].'.'.$pathInfo['extension'];
        if(!is_dir(Yii::$app->params['fileSavePath'].'/'.$savePath)){
            mkdir(Yii::$app->params['fileSavePath'].'/'.$savePath, 0777, true);
        }
        if($this->app->cache->set($file['token'], $file)){
            exit(json_encode(['success' => true, 'token' => $file['token'], 'message' => 'ok']));
        }        
    }

    public function actionPicture()
    {
        $token = $this->request->get('token');
        $fileInfo = $this->app->cache->get($token);
        if($fileInfo['size'] > $fileInfo['up_size']){
            $data = file_get_contents('php://input', 'r');
            if(!empty($data)){
                $fp = fopen(Yii::$app->params['fileSavePath'].'/'.$fileInfo['filePath'], 'a');
                flock($fp, LOCK_EX);
                fwrite($fp, $data);
                flock($fp, LOCK_UN);
                fclose($fp);
                $fileInfo['up_size'] += strlen($data);
                if($fileInfo['size'] > $fileInfo['up_size']){
                    $this->app->cache->set($file['token'], $file);
                }
            }
        }
        //裁剪图片为宽度不超过750px
        if(file_exists(Yii::$app->params['fileSavePath'].'/'.$fileInfo['filePath'])){
            $editor = Grafika::createEditor();        
            $editor->open($thumb, Yii::$app->params['fileSavePath'].'/'.$fileInfo['filePath']);
            if($thumb->getWidth() >= 750){
                $editor->resizeExactWidth($thumb , 750);
                $editor->save($thumb , Yii::$app->params['fileSavePath'].'/'.$fileInfo['filePath']);
            }
        }        
        exit(json_encode(['up_size' => true, 'start' => $fileInfo['up_size'], 'path' => $fileInfo['filePath'], 'url' => Yii::$app->params['imgUrl'].$fileInfo['filePath']]));
        
    }
}