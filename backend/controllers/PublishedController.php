<?php
/**
 * 发布管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 08:45:17
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Published;
use yii\helpers\Url;

class PublishedController extends AdminController
{
    private $published;
    public $enableCsrfValidation = false;    

    public function init()
    {
        parent::init();
        $this->published = new Published;
    }

    public function actionIndex()
    {
        $data['type'] = (int)$this->request->get('type');
        $status = 0;
        $data['username'] = $this->request->get('username');
        $data['title'] = $this->request->get('title');
        $page = (int)$this->request->get('page') ? (int)$this->request->get('page') : 1;
        $pageSize = 10;
        $data['list'] = $this->published->list($data['type'], $status, $data['username'], $data['title'], $page, $pageSize, $totalPage);
        $data['pagination'] =  $this->published->pagination($totalPage, $page, Url::to([
            '/published', 
            'page' => 'PAGENUMPLACEHOLDER', 
            'type' => $data['type'],
            'username' => $data['username'],
            'title' => $data['title']
        ]), 10);
        return $this->render('index', $data);
    }

    public function actionEdit()
    {
        $pid = $this->request->get('pid');
        $data['detail'] = $this->published->getEditInfo($pid);
        return $this->render('edit', $data);
    }

    public function actionShow()
    {
        $pid = $this->request->get('pid');
        $data['detail'] = $this->published->detail($pid);
        return $this->render('show', $data);
    }

    public function actionSave()
    {
        $act = $this->request->post('act');
        $pid = (int)$this->request->post('pid');
        switch ($act) {
            case 'update':
                $data = [
                    'status' => $this->request->post('status')
                ];
                if($this->published->update($pid, $data)){
                    $this->jsonExit(0, '数据更新成功', ['url' => Url::to(['/published'])]);
                }else{
                    $this->jsonExit(-1, '数据没有被更改或更新失败');
                }
                break;

            case 'delete':
                if($this->published->delete($pid)){
                    $this->jsonExit(0, '记录已成功删除');
                }else{
                    $this->jsonExit(-1, '记录删除失败，请稍后重试');
                }
                break;
            
            default:
                
                break;
        }
    }
}