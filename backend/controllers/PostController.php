<?php
/**
 * 文章管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-08-01 09:36:36
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Post;
use backend\models\Category;
use backend\models\Tags;
use yii\helpers\Url;

class PostController extends AdminController
{
    private $posts;

    public function init()
    {
        parent::init();
        $this->posts = new Post;
    }

    public function actionIndex()
    {
        $pageSize = 10;
        $data['id'] = $this->request->get('id');
        $data['title'] = $this->request->get('title');
        $page = intval($this->request->get('page', 1)) ? intval($this->request->get('page', 1)) : 1;
        $data['list'] = $this->posts->postsList($data['id'], $data['title'], $pageSize, $page, $totalPage);
        $data['pagination'] = $this->posts->pagination($totalPage, $page, Url::to(['/post', 'page' => 'PAGENUMPLACEHOLDER']), 10);
        return $this->render('index', $data);
    }

    public function actionAdd()
    {
        $category = new Category;
        $tags = new Tags;
        $data['mainCate'] = $category->subCateList(0);
        $data['tags'] = $tags->cateTags(1);
        return $this->render('add', $data);
    }

    public function actionEdit($id)
    {
        $data['detail'] = $this->posts->detail($id);
        $category = new Category;
        $tags = new Tags;
        if($data['detail']['fid'] == $data['detail']['lid']){
            $data['cate'] = $category->subCateList(0);
        }else{
            $data['cate'] = $category->subCateList(0);
        }
        $cate = $category->categoryLevelByLastLevel($data['detail']['lid']);
        $data['cateList'] = $category->categoryLevelList($cate);
        $data['tags'] = $tags->cateTags(1);
        $data['postTags'] = $this->posts->postTags($id);
        return $this->render('edit', $data);
    }

    public function actionRecommend($id)
    {
        $this->layout = 'iframe';
        $data['recommendType'] = $this->posts->getRecommendType($id);
        $data['pid'] = $id;
        return $this->render('recommend', $data);
    }

    public function actionAction()
    {
        $act = $this->request->post('act');
        switch ($act) {
            case 'cate':
                $category = new Category;
                $pid = $this->request->post('pid');
                $list = $category->subCateList($pid);
                if(count($list) > 0){
                    $this->jsonExit(0, '', $list);
                }else{
                    $this->jsonExit(-1, '列表为空');
                }
                break;

            case 'add':
                $cate = $this->request->post('cate');
                $fid = $cate[0];
                $lid = array_pop($cate);
                $data = [
                    'fid' => $fid,
                    'lid' => $lid,
                    'title' => $this->request->post('title'),
                    'thumbnail' => $this->request->post('thumbnail'),
                    'abstract' => $this->request->post('abstract'),
                    'posts' => $this->request->post('posts'),
                    'display_order' => $this->request->post('display_order'),
                    'author' => $this->session->get('user')['username'],
                    'authorid' => $this->session->get('user')['id'],
                    'tags' => $this->request->post('tags') ? $this->request->post('tags') : []
                ];
                $rst = $this->posts->addPost($data);
                if($rst){
                    $this->jsonExit(0, '文章添加成功');
                }else{
                    $this->jsonExit(-1, '文章添加失败');
                }
                break;

            case 'edit':
                $id = $this->request->post('id');
                $cate = $this->request->post('cate');
                $fid = $cate[0];
                $lid = array_pop($cate);
                $data = [
                    'fid' => $fid,
                    'lid' => $lid,
                    'title' => $this->request->post('title'),
                    'thumbnail' => $this->request->post('thumbnail'),
                    'abstract' => $this->request->post('abstract'),
                    'posts' => $this->request->post('posts'),
                    'display_order' => $this->request->post('display_order'),
                    'tags' => $this->request->post('tags') ? $this->request->post('tags') : []
                ];
                $rst = $this->posts->updatePost($id, $data);
                if($rst){
                    $this->jsonExit(0, '文章编辑成功');
                }else{
                    $this->jsonExit(-1, '文章编辑失败');
                }
                break;

            case 'upload':
                $upload = new \common\models\Upload;
                $upload->saveDir = 'posts';
                $rst = $upload->uploadFile();
                if($rst['code'] === 0){
                    $this->jsonExit(0, '文件上传成功！', array('path' => $rst['path'], 'url' => $this->params['imgUrl'].$rst['path']));
                }else{
                    $this->jsonExit(-1, '文件上传失败，请重试！');
                }
                break;

            case 'recommend':
                $pid = $this->request->post('pid');
                $recommendType = $this->request->post('recommend_type');
                if($this->posts->recommendPost($pid, $recommendType)){
                    $this->jsonExit(0, '文章推荐成功');
                }else{
                    $this->jsonExit(-1, '文章推荐失败');
                }
                break;

            case 'changeStatus':
                $id = $this->request->post('id');
                $status = $this->request->post('status');
                $rst = $this->posts->changePostStatus($id, $status);
                if($rst){
                    $this->jsonExit(0, '文章状态更改成功');
                }else{
                    $this->jsonExit(-1, '文章状态更改失败');
                }
                break;
            
            default:
                # code...
                break;
        }
    }
}