<?php
/**
 * 获取轮播图
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-07 11:02:42
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class Banner extends CommonModel
{
    public function bannerList()
    {
        $list = $this->db->createCommand('select id, title, href, picture from {{%slide_banner}} where begin_time <= :curTime and end_time >= :curTime and status = 0 order by sort desc', ['curTime' => date('Y-m-d H:i:s')])->queryAll();
        return $list;
    }
}