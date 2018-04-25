<?php
/**
 * 用户管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-21 16:42:38
 * @version $Id$
 */

$this->title = '用户管理-列表';
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
            <a href="<?php echo Url::to(['/user']); ?>">用户管理</a>
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
                    <span class="caption-subject bold uppercase"> 用户管理 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">                    
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="list-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> 头像 </th>
                            <th> 用户名 </th>
                            <th> 手机号码 </th>
                            <th> 状态 </th>
                            <th> 注册时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) {?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><img width="50" src="<?=Yii::$app->params['imgUrl'].$v['avatar']?>" alt="<?=$v['username']?>"></td>
                            <td><?=$v['username']?></td>
                            <td><?=$v['mobile']?></td>
                            <td>
                                <?php
                                    if($v['status'] == 1){
                                        echo '<span class="label label-sm label-success"> 正常 </span>';
                                    }elseif($v['status'] == 2){
                                        echo '<span class="label label-sm label-danger"> 禁用 </span>';
                                    }
                                ?>
                            </td>
                            <td><?=$v['created_at']?></td>
                            <td>
                                <a class="edit" href="<?=Url::to(['/user/edit', 'suid' => $v['id']])?>"> 编辑 </a>&nbsp;
                                <a class="edit" href="<?=Url::to(['/user/show', 'suid' => $v['id']])?>"> 查看 </a>
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
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['/user/save']); ?>">
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
                    targets: [6]
                }],
                order: []
            });
        ');
?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/scripts/datatable.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/datatables/jquery.dataTables.min.js'); ?>