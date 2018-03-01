<?php
/**
 * 标签管理
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-07 12:41:34
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Tags;
use yii\helpers\Url;

class TagsController extends AdminController
{
    
    public function actionIndex()
    {
        $tags = new Tags;
        $cate = 1;
        $page = intval($this->request->get('page')) ? intval($this->request->get('page')) : 1;
        $pageSize = 10;
        $data['list'] = $tags->tagsList($cate, $pageSize, $page, $totalPage);
        $data['pagination'] = $tags->pagination($totalPage, $page, Url::to(['/tags', 'page' => 'PAGENUMPLACEHOLDER']), 10);   
        return $this->render('index', $data);
    }

    /**
     * 添加标签
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 编辑标签
     */
    public function actionEdit($id)
    {
        $tags = new Tags;
        $data['detail'] = $tags->detail($id);
        return $this->render('edit', $data);
    }

    /**
     * 数据操作
     */
    public function actionSave()
    {
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $act = $this->request->post('act');
        $tags = new Tags;
        switch ($act) {
            case 'add':
                $data = [
                    'name' => $this->request->post('name'),
                    'remarks' => $this->request->post('remarks'),
                    'created' => $this->session->get('user')['username']
                ];
                if($tags->insert($data)){
                    $this->jsonExit(0, '标签添加成功', ['url' => url::to(['/tags'])]);
                }else{
                    $this->jsonExit(-1, '标签添加失败');
                }
                break;

            case 'edit':
                $data = [
                    'name' => $this->request->post('name'),
                    'remarks' => $this->request->post('remarks')
                ];
                $id = $this->request->post('id');
                if($tags->update($data, $id) !== false){
                    $this->jsonExit(0, '标签编辑成功', ['url' => url::to(['/tags'])]);
                }else{
                    $this->jsonExit(-1, '标签编辑失败');
                }
                break;
            
            default:
                # code...
                break;
        }
    }
}