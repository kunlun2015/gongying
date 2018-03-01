<?php
/**
 * 站点信息管理
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-23 12:54:21
 * @version $Id$
 */

$this->title = '站点信息管理-添加';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/site-info']); ?>">站点信息</a>
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
                    <span class="caption-subject font-dark sbold uppercase">站点信息</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal add-form" role="form" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">标题</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" placeholder="标题名称" value="<?php if(isset($detail['title'])) echo $detail['title']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">内容</label>
                            <div class="col-md-9">
                                <script id="container" name="content" type="text/plain"><?php if(isset($detail['content'])) echo $detail['content']; ?></script>
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
                    <input type="hidden" name="act" value="<?php if(isset($detail['id'])){echo 'edit';}else{echo 'add';} ?>">
                    <?php if(isset($detail['id'])){ ?>
                    <input type="hidden" name="id" value="<?=$detail['id']?>">
                    <?php } ?>
                    <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['/site-info/action']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<script> var page = 'addSiteInfo'</script>
<?php  \backend\assets\AppAsset::addScript($this, 'static/plugin/ueditor1_4_3_3/ueditor.config.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/plugin/ueditor1_4_3_3/ueditor.all.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/site-info.js'); ?>
  