<?php
/**
 * 标签管理
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-07 12:43:04
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
            <a href="<?php echo Url::to(['/tags']); ?>">标签管理</a>
            <i class="fa fa-angle-right"></i>
        </li>        
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 标签管理 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group fr">
                                <a href="<?=Url::to(['tags/add'])?>" class="btn sbold green"> 添加
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="list-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> 分类 </th>
                            <th> 名称 </th>
                            <th> 使用数量 </th>
                            <th> 创建时间 </th>
                            <th> 创建人 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) {?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?=$v['cate']?></td>
                            <td><?=$v['name']?></td>
                            <td><?=$v['nums']?></td>
                            <td><?=$v['create_at']?></td>
                            <td><?=$v['created']?></td>
                            <td>
                                <a href="<?=Url::to(['tags/edit', 'id' => $v['id']])?>" class="btn btn-sm btn-outline green"> 编辑 </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row kl-pagination"><?=$pagination?></div>
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['category/save']); ?>">
<?php 
    $this->registerJs('
            $("#list-table").dataTable({
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
<?php \backend\assets\AppAsset::addScript($this, 'static/js/tags.js'); ?>