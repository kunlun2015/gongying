<?php
/**
 * 文章管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-08-01 09:45:09
 * @version $Id$
 */

$this->title = '文章管理-列表';
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
            <a href="<?php echo Url::to(['/post']); ?>">文章管理</a>
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
                    <span class="caption-subject bold uppercase"> 文章管理 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group fr">
                                <a href="<?=Url::to(['post/add'])?>" class="btn sbold green"> 添加
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
                            <th> 标题 </th>
                            <th> 作者 </th>
                            <th> 置顶 </th>
                            <th> 状态 </th>
                            <th> 创建时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v){ ?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><a href="http://www.debugphp.com/<?=$v['fmap']?>/<?=$v['id']?>.html?key=<?=md5($v['title'].$v['fmap'].date('YmdH'))?>" target="_blakn"><?=$v['title']?></a></td>
                            <td><?=$v['author']?></td>
                            <td>
                                <?php
                                    if($v['display_order'] == 0){
                                        echo '正常';
                                    }elseif($v['display_order'] == 1){
                                        echo '分类置顶';
                                    }elseif($v['display_order'] == 2){
                                        echo '版块置顶';
                                    }elseif($v['display_order'] == 3){
                                        echo '全局置顶';
                                    }
                                ?>
                            </td>
                            <td class="post-status">
                                <?php
                                    if($v['status'] == 0){
                                        echo '<span class="label label-sm label-success"> 正常 </span>';
                                    }elseif($v['status'] == -1){
                                        echo '<span class="label label-sm label-warning"> 审核中 </span>';
                                    }elseif($v['status'] == -2){
                                        echo '<span class="label label-sm label-danger"> 禁用 </span>';
                                    }
                                ?>
                            </td>
                            <td><?=$v['create_at']?></td>
                            <td>
                                <a href="<?=Url::to(['post/edit', 'id' => $v['id']])?>" class="btn btn-sm btn-outline green"> 编辑 </a>
                                <a href="<?=Url::to(['post/recommend', 'id' => $v['id']])?>" class="btn btn-sm btn-outline green recommend"> 推荐 </a>
                                <a href="javascript:;" class="btn btn-sm btn-outline red"> 删除 </a>
                                <a href="javascript:;" class="btn btn-sm btn-outline green change-status-btn"> 状态 </a>
                                <ul class="change-status-act">
                                    <li><a href="javascript:;" data-id="<?=$v['id']?>" data-status="0" class="btn btn-sm btn-outline green"> 正常 </a></li>
                                    <li><a href="javascript:;" data-id="<?=$v['id']?>" data-status="-1" class="btn btn-sm btn-outline yellow"> 审核中 </a></li>
                                    <li><a href="javascript:;" data-id="<?=$v['id']?>" data-status="-2" class="btn btn-sm btn-outline red"> 禁用 </a></li>
                                </ul>
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
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['post/action']); ?>">
<script> var page = 'indexPost'</script>
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
<?php \backend\assets\AppAsset::addScript($this, 'static/js/post.js'); ?>