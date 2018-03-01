<?php
/**
 * 网站分类结构
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-26 14:05:53
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Category;
use yii\helpers\Url;

class CategoryController extends AdminController
{

    public function actionIndex()
    {
        $category = new Category;
        $data['parentId'] = $this->request->get('pid', 0);
        $data['level'] = $category->categoryLevel($data['parentId']);
        $data['list'] = $category->categoryList($data['parentId']);
        return $this->render('index', $data);
    }

    //添加分类
    public function actionAdd()
    {
        $data['pid'] = intval($this->request->get('id', 0)) ? intval($this->request->get('id', 0)) : 0;
        return $this->render('add', $data);
    }

    //编辑分类
    public function actionEdit()
    {
        $id = intval($this->request->get('id', 0)) ? intval($this->request->get('id', 0)) : 0;
        $category = new Category;
        $data['detail'] = $category->detail($id);
        return $this->render('edit', $data);
    }

    //数据操作
    public function actionSave()
    {
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $act = $this->request->post('act');
        $category = new Category;
        switch ($act) {
            case 'add':
                $data = array(
                    'pid' => intval($this->request->post('pid')) ? intval($this->request->post('pid')) : 0,
                    'name' => $this->request->post('name'),
                    'href' => $this->request->post('href') ? $this->request->post('href') : '',
                    'sort' => $this->request->post('sort') ? $this->request->post('href') : 0,
                    'remarks' => $this->request->post('remarks'),
                    'created' => $this->session->get('user')['username']
                    );
                $rst = $category->addCategory($data);
                if($rst){
                    $this->jsonExit(0, '分类添加成功！');
                }else{
                    $this->jsonExit(-1, '分类添加失败，请稍候重试！');
                }
                break;

            case 'edit':
                $data = [
                    'name' => $this->request->post('name'),
                    'href' => $this->request->post('href') ? $this->request->post('href') : '',
                    'sort' => $this->request->post('sort') ? $this->request->post('href') : 0,
                    'remarks' => $this->request->post('remarks')
                ];
                $id = $this->request->post('id');
                $rst = $category->editCategory($id, $data);
                if($rst !== false){
                    $this->jsonExit(0, '分类编辑成功！');
                }else{
                    $this->jsonExit(-1, '分类编辑失败，请稍候重试！');
                }
                break;

            case 'delete':
                $id = $this->request->post('id');
                $rst = $category->deleteCategory($id);
                if($rst !== false){
                    $this->jsonExit(0, '分类删除成功！');
                }else{
                    $this->jsonExit(-1, '分类删除失败，请稍候重试！');
                }
                break;
            
            default:
                # code...
                break;
        }
    }
}