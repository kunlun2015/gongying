<?php
/**
 * 文章管理-编辑
 * @authors: Amos (735767227@qq.com)
 * @date: 2017-08-01 18:17
 * @version $Id$
 */

$this->title = '文章管理-编辑';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/post']); ?>">文章管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>编辑</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">编辑文章</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal add-post-form" role="form" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章名称</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" placeholder="类别名称" value="<?=$detail['title']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章分类</label>
                            <div class="col-md-9">
                                <?php foreach ($cateList as $k => $v){ ?>
                                <select name="cate[]" class="form-control input-inline">
                                    <option value="">请选择所属分类</option>
                                    <?php foreach($v['list'] as $k2 => $v2){ ?>
                                    <option value="<?=$v2['id']?>" <?php if($v2['id'] == $v['id']) echo 'selected'; ?>><?=$v2['name']?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">摘要</label>
                            <div class="col-md-9">
                                <textarea name="abstract" class="form-control input-xlarge" rows="3" placeholder="摘要"><?=$detail['abstract']?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章封面</label>
                            <div class="col-md-9">
                                <input type="text" name="thumbnail" class="form-control input-inline input-xlarge" readonly placeholder="图片地址" value="<?=$detail['thumbnail']?>">
                                <input type="button" class="btn green select-thumbnail-btn" value="上传图片">
                                <input type="file" class="none" name="file" id="post-thumbnail-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章内容</label>
                            <div class="col-md-9">
                                <script id="container" name="posts" type="text/plain"><?=$detail['posts']?></script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">标签</label>
                            <div class="col-md-9">
                                <div class="icheck-inline">
                                    <?php foreach ($tags as $k => $v) { ?>
                                    <label>
                                        <input type="checkbox" name="tags[]" value="<?=$v['id']?>" <?php if(in_array($v['id'], $postTags)) echo 'checked'; ?> class="icheck"> <?=$v['name']?>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">置顶</label>
                            <div class="col-md-9">
                                <div class="icheck-inline">
                                    <label>
                                        <input type="radio" name="display_order" <?php if($detail['display_order'] == 0) echo 'checked'; ?> class="icheck" value="0"> 正常
                                    </label>
                                    <label>
                                        <input type="radio" name="display_order" <?php if($detail['display_order'] == 1) echo 'checked'; ?> class="icheck" value="1"> 分类置顶
                                    </label>
                                    <label>
                                        <input type="radio" name="display_order" <?php if($detail['display_order'] == 2) echo 'checked'; ?> class="icheck" value="2"> 版块置顶
                                    </label>
                                    <label>
                                        <input type="radio" name="display_order" <?php if($detail['display_order'] == 3) echo 'checked'; ?> class="icheck" value="3"> 全局置顶
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">确 定</button>
                                <button type="button" class="btn default">取 消</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="act" value="edit">
                    <input type="hidden" name="id" value="<?=$detail['id']?>">
                    <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['post/action']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<script> var page = 'addPost'</script>
<?php  \backend\assets\AppAsset::addScript($this, 'static/plugin/ueditor1_4_3_3/ueditor.config.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/plugin/ueditor1_4_3_3/ueditor.all.js'); ?>
<?php  \backend\assets\AppAsset::addCss($this, 'static/global/plugins/icheck/skins/all.css'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/global/plugins/icheck/icheck.min.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/plugin/jquery-file-upload/jquery.ui.widget.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/plugin/jquery-file-upload/jquery.fileupload.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/post.js'); ?>
