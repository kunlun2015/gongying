<?php
/**
 * banner轮播图数据管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-24 13:24:30
 * @version $Id$
 */

namespace backend\models;
use yii\base\Model;

class Banner extends CommonModel{

    //轮播图分类
    public function bannerCate(){
        return array(
                    1 => '首页轮播图'
                );
    }

    //获取banner轮播图列表
    public function bannerList($cate_id, $pageSize, $pageNum, &$totalPage){
        $offset = ($pageNum - 1)*$pageSize;
        $sql = 'select id, cate_id, title, picture, status, sort, begin_time, end_time from {{%slide_banner}} where 1 = 1';
        $sql_total = 'select count(*) from {{%slide_banner}} where 1 = 1';
        if($cate_id){
            $sql .= ' and cate_id = :cate_id ';
            $sql_total .= ' and cate_id = '.$cate_id;
        }
        $sql .= " order by id desc limit $offset, $pageSize";
        $list = $this->db->createCommand($sql, array('cate_id' => $cate_id))->queryAll();
        $totalPage = $this->getTotalPage($sql_total, $pageSize);
        return $list;
    }

    //添加轮播banner
    public function addBanner($data){
        return $this->db->createCommand()->insert('{{%slide_banner}}', $data)->execute();
    }

    //编辑banner轮播图
    public function editBanner($data, $id){
        return $this->db->createCommand()->update('{{%slide_banner}}', $data, array('id' => $id))->execute();
    }

    //删除banner
    public function deleteBanner($bannerId){
        return $this->db->createCommand()->delete('{{%slide_banner}}', array('id' => $bannerId))->execute();
    }

    //获取banner轮播图详情
    public function getBannerById($id){
        return $this->db->createCommand('select id, cate_id, title, href, sort, begin_time, end_time, picture from {{%slide_banner}} where id = :id', array('id' => $id))->queryOne();
    }
}