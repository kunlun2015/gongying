<?php
/**
 * 用户权限管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-13 18:17:58
 * @version $Id$
 */
$this->title = '用户权限管理';
use yii\helpers\Url; 
?>
<h3 class="page-title"> 用户权限管理
    <small>用户权限添加、修改等</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo Url::to(['root/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['root/user']); ?>">用户管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>权限管理</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-shield"></i> Another action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user"></i> Something else here</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-bag"></i> Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 用户权限管理 </span>
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
                <form  class="form-horizontal user-authority-form" role="form">
                <div class="form-body">
                    <div id="tree-authority"></div>                         
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn green submit-authority">确 定</button>
                            <button type="button" class="btn default">取 消</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="act" value="authority">
                <input type="hidden" name="uid" value="<?=$uid?>">
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['root/user/action']); ?>">  
                </form>              
            </div>            
        </div>
    </div>
</div>
<script>
    var treeMenuData  = <?=$menuTree?>;
    var userAuthority = <?=$authority?>;
</script>
<?php \backend\assets\RootAsset::addCss($this, 'static/global/plugins/jstree/dist/themes/default/style.min.css'); ?>
<?php \backend\assets\RootAsset::addScript($this, 'static/global/plugins/jstree/dist/jstree.min.js'); ?>
<?php \backend\assets\RootAsset::addScript($this, 'static/js/root/user.js'); ?>