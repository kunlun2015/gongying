<?php
/**
 * 分类管理-列表
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-26 17:01:47
 * @version $Id$
 */

$this->title = '分类管理-列表';
use yii\helpers\Url;
?>
<!-- BEGIN PAGE BAR -->
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
        <?php foreach ($level as $k => $v) {?>
        <li>
            <a href="<?php echo Url::to(['/category', 'pid' => $v['id']]); ?>"><?=$v['name']?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <?php } ?>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 分类管理 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group fr">
                                <a href="<?php echo Url::to(['category/add', 'id' => $parentId]); ?>" class="btn sbold green"> 添加
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="banner-list-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> 名称 </th>
                            <th> 排序 </th>
                            <th> 状态 </th>
                            <th> 创建时间 </th>
                            <th> 创建人 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) { ?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?=$v['name']?></td>
                            <td><?=$v['sort']?></td>
                            <td><?=$v['status']?></td>
                            <td><?=$v['create_at']?></td>
                            <td><?=$v['created']?></td>
                            <td>
                                <a href="<?=Url::to(['category/edit', 'id' => $v['id']])?>">编辑</a>
                                <a href="javascript::void(0);" class="delete" data-id="<?=$v['id']?>">删除</a>
                                <a href="<?=Url::to(['/category', 'pid' =>$v['id']])?>">查看子菜单</a>
                                <a href="<?=Url::to(['/category/add', 'id' =>$v['id']])?>">添加子菜单</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['category/save']); ?>">
<?php 
    $this->registerJs('
            $("#banner-list-table").dataTable({
                bPaginate: false,
                bInfo: false,
                bFilter: false,
                language: {
                    emptyTable: "暂无列表数据" 
                },
                columnDefs: [{
                    orderable: !1,
                    targets: [0, 6]
                }],
                order: []
            });
        ');
?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/scripts/datatable.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/js/category.js'); ?>