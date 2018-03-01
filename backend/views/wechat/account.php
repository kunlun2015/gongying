<?php
/**
 * 微信模块
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-01-31 15:55:34
 * @version $Id$
 */

$this->title = '账号管理';
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
            <span>列表</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">账号管理</span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group fr">
                                <a href="<?=Url::to(['wechat/account-add'])?>" class="btn sbold green"> 添加
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
                            <th> 名称 </th>
                            <th> 微信号 </th>
                            <th> appId </th>
                            <th> 创建时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) {?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?=$v['name']?></td>
                            <td><?=$v['wx_id']?></td>
                            <td><?=$v['appID']?></td>
                            <td><?=$v['create_at']?></td>
                            <td>
                                <a href="<?=Url::to(['wechat/account-edit', 'id' => $v['id']])?>" class="btn btn-sm btn-outline green"> 编辑 </a>
                                <a href="javascript:;" class="btn btn-sm btn-outline red"> 删除 </a>
                                <a href="<?=Url::to(['wechat/account-access-info', 'id' => $v['id']])?>" class="btn btn-sm btn-outline green recommend"> 查看接入信息 </a>
                            </td>
                        </tr>
                        <?php } ?>
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
                    targets: [5]
                }],
                order: []
            });
        ');
?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/scripts/datatable.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/js/wechat.js'); ?>