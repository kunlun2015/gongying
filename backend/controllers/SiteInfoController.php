<?php
/**
 * 管理站点信息
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-23 12:48:56
 * @version $Id$
 */

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\SiteInfo;
use yii\helpers\Url;

class SiteInfoController extends AdminController
{

    public function actionIndex()
    {
        $page = $this->request->get('page') ? $this->request->get('page') : 1;
        $pageSize = 10;
        $siteInfo = new SiteInfo;
        $data['list'] = $siteInfo->siteInfoList($page, $pageSize, $totalPage);
        return $this->render('index', $data);
    }

    //添加
    public function actionAdd()
    {
        $id = $this->request->get('id');
        $data = [];
        if($id){
            $siteInfo = new SiteInfo;
            $data['detail'] = $siteInfo->detail($id);
        }
        return $this->render('add', $data);
    }

    //数据处理
    public function actionAction()
    {
        if(!$this->request->isAjax){
            $this->jsonExit(-1, '非法请求！');
        }
        $act = $this->request->post('act');
        $siteInfo = new SiteInfo;
        switch ($act) {
            case 'add':
                $data = [
                    'title' => $this->request->post('title'),
                    'content' => $this->request->post('content'),
                    'created' => $this->session->get('user')['username']
                ];
                $rst = $siteInfo->add($data);
                if($rst){
                    $this->jsonExit(0, '数据已成功保存', ['url' => Url::to(['/site-info'], true)]);
                }else{
                    $this->jsonExit(-1, '数据保存失败，请稍后重试');
                }
                break;

            case 'edit':
                $data = [
                    'title' => $this->request->post('title'),
                    'content' => $this->request->post('content')
                ];
                $id = $this->request->post('id');
                $rst = $siteInfo->edit($id, $data);
                if($rst){
                    $this->jsonExit(0, '数据已成功保存', ['url' => Url::to(['/site-info'], true)]);
                }else{
                    $this->jsonExit(-1, '数据保存失败，请稍后重试');
                }
                break;
            
            default:
                # code...
                break;
        }
    }
}