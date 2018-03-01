<?php
/**
 * 文章管理-添加
 * @authors Amos (735767227@qq.com)
 * @date    2017-08-01 09:51:36
 * @version $Id$
 */
$this->title = '文章管理-添加';
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
            <span>添加</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">添加文章</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal add-post-form" role="form" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章名称</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" placeholder="类别名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章分类</label>
                            <div class="col-md-9">
                                <select name="cate[]" class="form-control input-inline">
                                    <option value="">请选择所属分类</option>
                                    <?php foreach($mainCate as $k => $v){?>
                                    <option value="<?=$v['id']?>"><?=$v['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">摘要</label>
                            <div class="col-md-9">
                                <textarea name="abstract" class="form-control input-xlarge" rows="3" placeholder="摘要"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章封面</label>
                            <div class="col-md-9">
                                <input type="text" name="thumbnail" class="form-control input-inline input-xlarge" readonly placeholder="图片地址">
                                <input type="button" class="btn green select-thumbnail-btn" value="上传图片">
                                <input type="file" class="none" name="file" id="post-thumbnail-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">文章内容</label>
                            <div class="col-md-9">
                                <script id="container" name="posts" type="text/plain"></script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">标签</label>
                            <div class="col-md-9">
                                <div class="icheck-inline">
                                    <?php foreach ($tags as $k => $v) { ?>
                                    <label>
                                        <input type="checkbox" name="tags[]" value="<?=$v['id']?>" class="icheck"> <?=$v['name']?>
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
                                        <input type="radio" name="display_order" checked class="icheck" value="0"> 正常
                                    </label>
                                    <label title="在栏目置顶显示">
                                        <input type="radio" name="display_order" class="icheck" value="1"> 栏目置顶
                                    </label>
                                    <label title="在类别置顶显示">
                                        <input type="radio" name="display_order" class="icheck" value="2"> 分类置顶
                                    </label>
                                    <label title="全局置顶">
                                        <input type="radio" name="display_order" class="icheck" value="3"> 全局置顶
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
                    <input type="hidden" name="act" value="add">
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
  