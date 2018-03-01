<?php
/**
 * 回复关键词
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-05 15:26:29
 * @version $Id$
 */
$this->title = '回复关键词';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/otags']); ?>">微信管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>回复关键字</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">回复关键字</span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group fr">
                                <a href="<?=Url::to(['wechat/reply-keywords-save'])?>" class="btn sbold green"> 添加
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
                            <th> 关键字 </th>
                            <th> 回复类型 </th>
                            <th> 创建时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
                    targets: [4]
                }],
                order: []
            });
        ');
?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/scripts/datatable.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/js/wechat.js'); ?>