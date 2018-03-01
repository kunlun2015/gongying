<?php
/**
 * 功能分组管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-11 13:58:43
 * @version $Id$
 */
use yii\helpers\Url;
$this->title = '功能管理-功能分组';
?>
<h3 class="page-title"> 功能分组管理
    <small>控制用户后台菜单分组</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo Url::to(['root/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['root/function-manage']); ?>">功能管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>功能分组</span>
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
<!-- END PAGE HEADER-->
<div class="note note-info">
    <p> A black page template with a minimal dependency assets to use as a base for any custom page you create </p>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 功能列表管理 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="#functio-group-add-modal" data-toggle="modal" class="btn sbold green"> 添加分组
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> 名称 </th>
                            <th> 排序 </th>
                            <th> 状态 </th>
                            <th> 添加时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $k => $v) { ?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?=$v['name']?></td>
                            <td><?=$v['sort']?></td>
                            <td>
                                <?php if($v['status'] == 0){ ?>
                                <span class="label label-sm label-success"> 正常 </span>
                                <?php }else if($v['status'] == 1){ ?> 
                                <span class="label label-sm label-warning"> 禁用 </span>
                                <?php } ?>
                            </td>
                            <td><?=$v['create_at']?></td>
                            <td>
                                <a class="edit-function-group" data-id="<?=$v['id']?>" href="<?php echo Url::to(['root/function-manage/function-group-edit-data']); ?>">编辑</a>
                                <a class="delete-function-group" data-id="<?=$v['id']?>" href="<?php echo Url::to(['root/function-manage/request-distribution']); ?>">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="functio-group-add-modal" data-backdrop="static" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">添加分组</h4>
    </div>
    <form class="form-horizontal functio-group-add-form" role="form">
    <div class="modal-body">
        <div class="portlet-body form">            
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">名称</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control input-inline input-medium" placeholder="分组名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">排序</label>
                        <div class="col-md-9">
                            <input type="text" name="sort" class="form-control input-inline input-medium" placeholder="分组排序(越大越靠前)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">分组说明</label>
                        <div class="col-md-9">
                            <textarea name="remarks" id="remarks" class="form-control" rows="5" placeholder="分组说明"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">状态</label>
                        <div class="col-md-9">
                            <div class="icheck-inline">
                                <label>
                                    <input type="radio" name="status" value="0" class="icheck" checked="checked" data-radio="iradio_square-grey"> 正常 
                                </label>
                                <label>
                                    <input type="radio" name="status" value="1" class="icheck" data-radio="iradio_square-grey"> 禁用 
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="act" value="addGroup">
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['root/function-manage/save']); ?>">            
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-outline dark">关闭</button>
        <button type="submit" class="btn green">保存</button>
    </div>
    </form>
</div>
<div id="functio-group-edit-modal" data-backdrop="static" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">编辑分组</h4>
    </div>
    <form class="form-horizontal functio-group-edit-form" role="form">
    <div class="modal-body">
        <div class="portlet-body form">            
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">名称</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control input-inline input-medium" placeholder="分组名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">排序</label>
                        <div class="col-md-9">
                            <input type="text" name="sort" class="form-control input-inline input-medium" placeholder="分组排序(越大越靠前)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">分组说明</label>
                        <div class="col-md-9">
                            <textarea name="remarks" id="remarks" class="form-control" rows="5" placeholder="分组说明"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">状态</label>
                        <div class="col-md-9">
                            <div class="icheck-inline">
                                <label>
                                    <input type="radio" name="status" value="0" class="icheck group-status" data-radio="iradio_square-grey"> 正常 
                                </label>
                                <label>
                                    <input type="radio" name="status" value="1" class="icheck group-status" data-radio="iradio_square-grey"> 禁用 
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="groupid" value="0">
                <input type="hidden" name="act" value="editGroup">
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['root/function-manage/save']); ?>">            
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-outline dark">关闭</button>
        <button type="submit" class="btn green">保存</button>
    </div>
    </form>
</div>
<?php \backend\assets\RootAsset::addScript($this, 'static/js/root/function-manage.js'); ?>