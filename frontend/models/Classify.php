<?php
/**
 * 分类
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-07 14:04:51
 * @version $Id$
 */

namespace frontend\models;
use yii;
use yii\base\Model;

class Classify extends CommonModel
{
    /**
     * 获取所有分类层级列表
     * @return array
     */
    public function classifyList()
    {
        $list = $this->classifyListByPid(0);
        foreach ($list as $k => $v) {
            $list[$k]['sub'] = $this->classifyListByPid($v['id']);
            foreach ($list[$k]['sub'] as $k2 => $v2) {
                $list[$k]['sub'][$k2]['sub'] = $this->classifyListByPid($v2['id']);
            }
        }
        return $list;
    }

    /**
     * 获取当前id下的分类列表
     * @param  int $pid 
     * @return array
     */
    public function classifyListByPid($pid)
    {
        return $this->db->createCommand('select id, pid, name from {{%category}} where pid = :pid order by sort desc', ['pid' => $pid])->queryAll();
    }

    /**
     * 获取类别信息
     * @param  int $id 类别id
     * @return array
     */
    public function classifyById($id)
    {
        return $this->db->createCommand('select id, pid, name from {{%category}} where id = :id', ['id' => $id])->queryOne();
    }
}