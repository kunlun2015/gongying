<?php
/**
 * model 基类，初始化方法及参数
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 10:40:26
 * @version $Id$
 */

namespace backend\models;
use yii;
use yii\base\Model;

class CommonModel extends \common\models\CommonModel{

    protected $db;
    protected $session;
    protected $params;

    public function init(){
        $this->db = Yii::$app->db;
        $this->session = Yii::$app->session;
        $this->params = Yii::$app->params;
    }

    //获取总页数
    protected function getTotalPage($sql, $pageSize){
        $rst = $this->db->createCommand($sql)->queryOne();
        return ceil($rst['count(*)']/$pageSize);
    }

    /**
     * 生成页码导航
     *
     *
     *
     */
    public function pagination($totalPage, $curPage, $pageHref, $pageNums = 10)
    {        
        $middlePage = ceil($pageNums/2);
        $pagination = '<ul class="pagination" style="visibility: visible;">';
        if($totalPage == 1 || $totalPage == 0){
            return '';
        }else{            
            if($curPage != 1){
                $pagination .= ' <li class="prev"><a href="'.str_replace('PAGENUMPLACEHOLDER', 1, $pageHref).'" title="第一页"><i class="fa fa-angle-double-left"></i>第一页</a></li>
                                <li class="prev"><a href="'.str_replace('PAGENUMPLACEHOLDER', $curPage-1, $pageHref).'" title="上一页"><i class="fa fa-angle-left"></i>上一页</a></li>';
            }
            for ($i=$curPage - $middlePage -1; $i <= $curPage + $middlePage; $i++) { 
                if($i < 1 || $i > $totalPage){
                    continue;
                }
                if($i == $curPage){
                    $pagination .= '<li class="active disabled"><a>'.$i.'</a></li>';
                }else{
                    $pagination .= '<li><a href="'.str_replace('PAGENUMPLACEHOLDER', $i, $pageHref).'" title="第'.$i.'页">'.$i.'</a></li>';
                }                
            }
            if($curPage != $totalPage){
                $pagination .= '<li class="next"><a href="'.str_replace('PAGENUMPLACEHOLDER', $curPage+1, $pageHref).'" title="下一页">下一页<i class="fa fa-angle-right"></i></a></li>
                                <li class="next"><a href="'.str_replace('PAGENUMPLACEHOLDER', $totalPage, $pageHref).'" title="最后一页">最后一页<i class="fa fa-angle-double-right"></i></a></li>';
            }
        }
        $pagination .= '</ul>';
        return $pagination;
    }

}