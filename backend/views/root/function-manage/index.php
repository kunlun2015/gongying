<?php
/**
 * 功能管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-10 17:37:00
 * @version $Id$
 */
use yii\helpers\Url;
$this->title = '功能管理';
?>
<h3 class="page-title"> 功能管理
    <small>控制用户后台功能菜单</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo Url::to(['root/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>功能管理</span>
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
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                           <a href="<?php echo Url::to(['root/function-manage/function-group', 'pid' => $pid]); ?>" class="my-btn-group">功能分组</a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="<?php echo Url::to(['root/function-manage/add', 'pid' => $pid]); ?>" class="btn sbold green"> 添加功能
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
                            <th> 所在组 </th>
                            <th> 控制器 </th>                        
                            <th> 状态 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) { ?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?=$v['name']?></td>
                            <td><?=$v['group_name']?></td>
                            <td><?=$v['controller']?></td>
                            <td>
                                <?php if($v['status'] == 0){ ?>
                                <span class="label label-sm label-success"> 正常 </span>
                                <?php }else if($v['status'] == 1){ ?> 
                                <span class="label label-sm label-warning"> 禁用 </span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="<?php echo Url::to(['root/function-manage/edit', 'id' => $v['id'], 'pid'=>$pid]); ?>">编辑</a>
                                <?php if($menuLevel != 3){ ?>
                                <a href="<?php echo Url::to(['root/function-manage', 'pid' => $v['id']]); ?>">查看</a>
                                <?php } ?>
                                <a class="del-function-menu" data-id="<?=$v['id']?>" href="<?php echo Url::to(['root/function-manage/request-distribution']); ?>">删除</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php \backend\assets\RootAsset::addScript($this, 'static/js/root/function-manage.js'); ?>