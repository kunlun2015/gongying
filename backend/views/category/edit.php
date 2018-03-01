<?php
/**
 * 分类管理-编辑
 * @authors Amos (735767227@qq.com)
 * @date    2017-07-31 14:55:11
 * @version $Id$
 */
$this->title = '分类管理-添加';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/category']); ?>">分类管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>编辑</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<h3 class="page-title"> 分类管理
    <small>网站类别分类</small>
</h3>
<div class="note note-info">
    <p> 管理网站的分类 </p>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">添加分类</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal add-category-form" role="form" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">类别名称</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control input-inline input-medium" placeholder="类别名称" value="<?=$detail['name']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">链接</label>
                            <div class="col-md-9">
                                <input type="text" name="href" class="form-control input-inline input-xlarge" placeholder="跳转链接" value="<?=$detail['href']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">排序</label>
                            <div class="col-md-9">
                                <input type="text" name="sort" class="form-control input-inline input-medium" placeholder="排序，越大越靠前" value="<?=$detail['sort']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">备注</label>
                            <div class="col-md-9">
                                <textarea name="remarks" id="remarks" cols="5" class="form-control" placeholder="备注"><?=$detail['remarks']?></textarea>
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
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['category/save']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/category.js'); ?>
  