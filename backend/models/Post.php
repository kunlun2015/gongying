<?php
/**
 * post model
 * @authors: Amos (735767227@qq.com)
 * @date: 2017-08-01 16:30
 * @version $Id$
 */
namespace backend\models;
use yii\base\Model;

class Post extends CommonModel
{
    //添加数据
    public function addPost($data)
    {
        $transaction = $this->db->beginTransaction();
        try {
            $this->db->createCommand()->insert('{{%post_basic}}', [
                'fid'      => $data['fid'],
                'lid'      => $data['lid'],
                'title'    => $data['title'],
                'abstract' => $data['abstract'],
                'thumbnail' => $data['thumbnail'],
                'display_order' => $data['display_order'],
                'status' => -1,
                'author'   => $data['author'],
                'authorid' => $data['authorid']
            ])->execute();
            $bid = $this->db->getLastInsertID();
            $this->db->createCommand()->insert('{{%posts}}', [
                'bid'   => $bid,
                'fid'   => $data['fid'],
                'lid'   => $data['lid'],
                'title' => $data['title'],
                'posts' => $data['posts']
            ])->execute();
            //插入标签
            $batchInsertData = [];
            foreach ($data['tags'] as $k => $v) {
                array_push($batchInsertData, ['pid' => $bid, 'tags_id' => $v]);
            }
            $this->db->createCommand()->batchInsert('{{%post_tags}}', ['pid', 'tags_id'], $batchInsertData)->execute();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            //throw $e;
            return false;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            //throw $e;
            return false;
        }
    }

    //编辑数据
    public function updatePost($id, $data)
    {
        $transaction = $this->db->beginTransaction();
        try {
            $this->db->createCommand()->update('{{%post_basic}}', [
                'fid'      => $data['fid'],
                'lid'      => $data['lid'],
                'title'    => $data['title'],
                'abstract' => $data['abstract'],
                'thumbnail' => $data['thumbnail'],
                'display_order' => $data['display_order']
            ], ['id' => $id])->execute();
            $this->db->createCommand()->update('{{%posts}}', [
                'fid'   => $data['fid'],
                'lid'   => $data['lid'],
                'title' => $data['title'],
                'posts' => $data['posts']
            ], ['bid' => $id])->execute();
            //删除原有标签，插入新标签
            $this->db->createCommand()->delete('{{%post_tags}}', ['pid' => $id])->execute();
            $batchInsertData = [];
            foreach ($data['tags'] as $k => $v) {
                array_push($batchInsertData, ['pid' => $id, 'tags_id' => $v]);
            }
            $this->db->createCommand()->batchInsert('{{%post_tags}}', ['pid', 'tags_id'], $batchInsertData)->execute();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            //throw $e;
            return false;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            //throw $e;
            return false;
        }
    }

    //文章列表
    public function  postsList($id, $title, $pageSize, $page, &$totalPage)
    {
        $offset = ($page - 1)*$pageSize;
        $sql = 'select id, fid, lid, author, authorid, title, display_order, status, views, comments, likes, unlikes, create_at from {{%post_basic}} where 1 = 1';
        $sqlTotal = 'select count(*) from {{%post_basic}} where 1 = 1';
        if($id){
            $sql .= " and id = $id";
            $sqlTotal .= " and id = $id";
        }
        if($title){
            $sql .= " and title like '%$title%'";
            $sqlTotal .= " and title like '%$title%'";
        }
        $sql .= " order by create_at desc limit $offset, $pageSize";
        $list = $this->db->createCommand($sql)->queryAll();
        foreach ($list as $k => $v) {
            $list[$k]['fmap'] = $this->params['cateMap'][$v['fid']];
        }
        $totalPage = $this->getTotalPage($sqlTotal, $pageSize);
        return $list;
    }

    //文章详情
    public function detail($id)
    {
        $detail = $this->db->createCommand('select t1.id, t1.fid, t1.lid, t1.title, abstract, thumbnail, display_order, status, posts from {{%post_basic}} t1 left join {{%posts}} t2 on t1.id = t2.bid where id = :id',
            ['id' => $id])->queryOne();
        return $detail;
    }

    /**
     * 推荐文章
     * @param int $pid 文章id
     * @param int $recommendType 推荐位置 1:首页左侧
     * @return boolen
     */
    public function recommendPost($pid, $recommendType)
    {
        return $this->db->createCommand()->update('{{%post_basic}}', ['recommend_type' => $recommendType], ['id' => $pid])->execute();
    }

    /**
     * 获取文章推荐类型
     * @param int $pid 文章id
     * @return int recommendType
     */
    public function getRecommendType($pid)
    {
        return $this->db->createCommand('select recommend_type from {{%post_basic}} where id = :id limit 1', ['id' => $pid])->queryColumn();
    }

    /**
     * 获取文章标签
     */
    public function postTags($pid)
    {
        return $this->db->createCommand('select tags_id from {{%post_tags}} where pid = :pid', ['pid' => $pid])->queryColumn();
    }

    /**
     * 更改文章状态
     * @param  int $id     
     * @param  int $status 文章状态，0：正常，-1：审核中，-2：禁用
     * @return boolen
     */
    public function changePostStatus($id, $status)
    {
        return $this->db->createCommand()->update('{{%post_basic}}', ['status' => $status], ['id' => $id])->execute();
    }
}
