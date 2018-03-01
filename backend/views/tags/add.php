<?php
/**
 * 添加标签
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-07 12:50:10
 * @version $Id$
 */
$this->title = '标签管理-添加';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/otags']); ?>">标签管理</a>
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
                    <span class="caption-subject font-dark sbold uppercase">添加标签</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal add-form" role="form" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">名称</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control input-inline input-medium" placeholder="标签名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">备注</label>
                            <div class="col-md-9">
                                <textarea name="remarks" id="remarks" cols="5" class="form-control" placeholder="备注"></textarea>
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
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['tags/save']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/tags.js'); ?>
  