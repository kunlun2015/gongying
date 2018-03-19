<?php
/**
 * 发布采购、供应
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-07 11:00:52
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\Classify;
use frontend\models\Published;
use Grafika\Grafika;

class PublishController extends AppController {

    private $user;

    public function init()
    {
        parent::init();
        $this->user = $this->session->get('user');
    }
    
    public function actionIndex()
    {
        $type = in_array($this->request->get('type'), ['purchase', 'supply']) ? $this->request->get('type') : null;
        if(!$type){
            return $this->app->runAction('publish/type');
        }
        $data['type'] = $type === 'purchase' ? 1 : 2;
        $classify = new Classify;
        $data['classify'] = $classify->classifyList();
        return $this->render('index', $data);
    }

    //发布类型选择
    public function actionType()
    {
        return $this->render('type');
    }

    //编辑发布
    public function actionEdit()
    {
        $id = $this->request->get('id');
        $classify = new Classify;
        $published = new Published;
        $data['classify'] = $classify->classifyList();
        $data['detail'] = $published->detail($id);
        return $this->render('edit', $data);
    }

    //发布保存
    public function actionSave()
    {
        $publish = new Published;
        $type = (int)$this->request->post('type');
        if($type === 1){
            $data = [
                'suid' => $this->user['id'],
                'type' => $type,
                'title' => $this->request->post('title'),
                'num' => $this->request->post('num'),
                'fid' => $this->request->post('fid'),
                'sid' => $this->request->post('sid'),
                'tid' => $this->request->post('tid'),
                'budget' => $this->request->post('budget'),
                'delivery_cycle' => $this->request->post('delivery_cycle'),
                'deadline' => $this->request->post('deadline'),
                'delivery_area' => $this->request->post('delivery_area'),
                'description' => $this->request->post('description'),
                'pictures' => $this->request->post('pictures') ? implode(',', $this->request->post('pictures')) : '',
                'anonymous' => $this->request->post('anonymous') ? $this->request->post('anonymous') : 0
            ];
        }elseif($type === 2){
            $data = [
                'suid' => 1,
                'type' => $type,
                'title' => $this->request->post('title'),
                'fid' => $this->request->post('fid'),
                'sid' => $this->request->post('sid'),
                'tid' => $this->request->post('tid'),
                'delivery_area' => $this->request->post('delivery_area'),
                'description' => $this->request->post('description'),
                'pictures' => $this->request->post('pictures') ? implode(',', $this->request->post('pictures')) : '',
                'anonymous' => $this->request->post('anonymous') ? $this->request->post('anonymous') : 0
            ];
        }
        
        //取第一张图片生成封面缩略图
        $pictures = explode(',', $data['pictures']);
        $thumbPath = Yii::$app->params['fileSavePath'].$pictures[0];        
        $editor = Grafika::createEditor();
        $editor->open($thumb, $thumbPath);
        $editor->resizeFill($thumb , 80 , 80);
        $editor->save($thumb , $thumbPath.'.thumb.jpg');
        
        if($publish->save($data)){
            $this->jsonExit(0, '发布成功', ['url' => Url::to(['/'])]);
        }else{
            $this->jsonExit(-1, '发布失败，请稍后重试');
        }
    }

    //更新发布
    public function actionUpdate()
    {
        $publish = new Published;
        $type = (int)$this->request->post('type');
        $id = (int)$this->request->post('id');
        if($type === 1){
            $data = [
                'title' => $this->request->post('title'),
                'num' => $this->request->post('num'),
                'fid' => $this->request->post('fid'),
                'sid' => $this->request->post('sid'),
                'tid' => $this->request->post('tid'),
                'budget' => $this->request->post('budget'),
                'delivery_cycle' => $this->request->post('delivery_cycle'),
                'deadline' => $this->request->post('deadline'),
                'delivery_area' => $this->request->post('delivery_area'),
                'description' => $this->request->post('description'),
                'pictures' => $this->request->post('pictures') ? implode(',', $this->request->post('pictures')) : '',
                'anonymous' => $this->request->post('anonymous') ? $this->request->post('anonymous') : 0,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }elseif($type === 2){
            $data = [
                'title' => $this->request->post('title'),
                'fid' => $this->request->post('fid'),
                'sid' => $this->request->post('sid'),
                'tid' => $this->request->post('tid'),
                'delivery_area' => $this->request->post('delivery_area'),
                'description' => $this->request->post('description'),
                'pictures' => $this->request->post('pictures') ? implode(',', $this->request->post('pictures')) : '',
                'anonymous' => $this->request->post('anonymous') ? $this->request->post('anonymous') : 0,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        //取第一张图片生成封面缩略图
        $pictures = explode(',', $data['pictures']);
        $thumbPath = Yii::$app->params['fileSavePath'].$pictures[0];        
        $editor = Grafika::createEditor();
        $editor->open($thumb, $thumbPath);
        $editor->resizeFill($thumb , 80 , 80);
        $editor->save($thumb , $thumbPath.'.thumb.jpg');

        if($publish->update($id, $data)){
            $this->jsonExit(0, '编辑成功', ['url' => Url::to(['/my/published'])]);
        }else{
            $this->jsonExit(-1, '编辑失败，请稍后重试');
        }
    }

    //删除发布
    public function actionDelete()
    {
        $published = new Published;
        $id = $this->request->post('id');
        if($published->delete($id)){
            $this->jsonExit(0, '删除成功');
        }else{
            $this->jsonExit(-1, '删除失败,请稍后重试');
        }
    }
}