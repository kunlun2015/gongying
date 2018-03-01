<?php
/**
 * 上传文件
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-21 15:27:15
 * @version $Id$
 */

namespace common\models;
use yii\base\Model;
use yii;
class Upload extends CommonModel{

    private $saveRootDir;//存储根目录
    private $uploadSaveDirs = array(); //允许保存的目录
    public $saveDir;


    //初始化上传参数
    public function init(){
        $this->saveRootDir = Yii::$app->params['fileSavePath'];
        $this->uploadSaveDirs = Yii::$app->params['uploadSaveDirs'];
    }

    //保存base64图片
    public function saveBase64Img($base64){
        if(!$this->checkSaveDir()){
            return array('code' => -1, 'msg' => '保存目录不存在！');
        }
        $fileSavePath = $this->fileSavePath();
        $base64Info = explode(',', $base64);
        $img = base64_decode($base64Info[1]);
        $savePath = $fileSavePath.'/'.$this->uploadFileNamed().'.jpeg';
        $rst = file_put_contents($this->saveRootDir.'/'.$savePath, $img);
        if($rst){
            return array('code' => 0, 'msg' => '图片已保存！', 'path' => $savePath);
        }else{
            return array('code' => -1, 'msg' => '图片保存失败！');
        }
    }

    //上传文件
    public function uploadFile(){
        if(!$this->checkSaveDir()){
            return array('code' => -1, 'msg' => '保存目录不存在！');
        }
        $fileSavePath = $this->fileSavePath();
        $savePath = $fileSavePath.'/'.$this->uploadFileNamed().$this->fileExt($_FILES['file']['name']);
        $rst = move_uploaded_file($_FILES['file']['tmp_name'], $this->saveRootDir.'/'.$savePath);
        if($rst){
            return array('code' => 0, 'msg' => '文件上传成功！', 'path' => $savePath);
        }else{
            return array('code' => -1, 'msg' => '文件上传失败！');
        }
    }

    //检查保存目录是否合法
    private function checkSaveDir(){
        return in_array($this->saveDir, $this->uploadSaveDirs);
    }

    //文件保存完整目录
    private function fileSavePath(){
        $savePath = $this->saveDir.'/'.date('Y').'/'.date('m');
        if(!is_dir($this->saveRootDir.'/'.$savePath)){
            mkdir($this->saveRootDir.'/'.$savePath, 0777, true);
        }
        return $savePath;
    }

    //文件保存命名
    private function uploadFileNamed(){
        return $this->randString(12, 0).date('YmdHis');
    }

    //获取文件扩展名
    private function fileExt($fileName){
        $fileNamedExt = explode('.', $fileName);
        return '.'.array_pop($fileNamedExt);
    }

}