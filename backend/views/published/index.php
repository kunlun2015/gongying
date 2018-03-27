<?php
/**
 * 发布管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 08:47:45
 * @version $Id$
 */

$this->title = '发布管理-列表';
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
            <a href="<?php echo Url::to(['/published']); ?>">发布管理</a>
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
                    <span class="caption-subject bold uppercase"> 发布管理 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <form class="search-form" action="">
                    <div class="row">
                        <label>
                            发布类型：
                            <select style="width: 80px !important;" name="type" id="type" class="form-control input-small input-inline">
                                <option value="0">全部</option>
                                <option value="1" <?php if($type == 1){echo 'selected';} ?>>求购</option>
                                <option value="2" <?php if($type == 2){echo 'selected';} ?>>供应</option>
                            </select>
                        </label>&nbsp;&nbsp;
                        <label>
                            发布用户：
                            <input type="text" name="username" value="<?=$username?>" class="form-control input-small input-inline" placeholder="用户名称">
                        </label>&nbsp;&nbsp;
                        <label>
                            标题：
                            <input type="text" name="title" value="<?=$title?>" class="form-control input-large input-inline" placeholder="发布标题">
                        </label>
                        <label>
                            <input style="margin-top: 1px;" class="btn sbold green btn-search" type="button" value="确定">
                        </label>
                    </div>
                    </form>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="list-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> 类型 </th>
                            <th> 发布用户 </th>
                            <th> 标题 </th>
                            <th> 状态 </th>
                            <th> 发布时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) {?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?php if($v['type'] == 1){echo '求购'; }elseif($v['type'] == 2){echo '供应';}?></td>
                            <td><?=$v['username']?></td>
                            <td><?=$v['title']?></td>
                            <td>
                                <?php
                                    if($v['status'] == 1){
                                        echo '<span class="label label-sm label-warning"> 审核中 </span>';
                                    }elseif($v['status'] == 2){
                                        echo '<span class="label label-sm label-success"> 审核通过 </span>';
                                    }elseif($v['status'] == 3){
                                        echo '<span class="label label-sm label-danger"> 审核未通过 </span>';
                                    }
                                ?>
                            </td>
                            <td><?=$v['created_at']?></td>
                            <td>
                                <a class="edit" href="<?=Url::to(['/published/edit', 'pid' => $v['id']])?>"> 编辑 </a>&nbsp;
                                <a class="edit" href="<?=Url::to(['/published/show', 'pid' => $v['id']])?>"> 查看 </a>&nbsp;
                                <a class="delete" data-pid="<?=$v['id']?>" href="javascript:;"> 删除 </a>
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
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['/published/save']); ?>">
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
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
        $('.btn-search').click(function(){
            $('.search-form').submit();
            return false;
        })
        $('.delete').click(function(){
            var _this = $(this);
            layer.confirm('确定要删除吗？删除后不能恢复！', {title: siteName+'提示您：', icon: 3}, function(index){
                $.ajax({
                    url: $("input[name='request_url']").val(),
                    type: 'post',
                    dataType: 'json',
                    data: {act: 'delete', pid: _this.data('pid')},
                    success: function(res){
                        if(res.code == 0){
                            layer.alert(res.msg);
                            _this.parents('tr').remove();
                        }else{
                            layer.alert(res.msg);
                        }
                    }
                })
            })
            return false;
        })
    })    
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/scripts/datatable.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/datatables/jquery.dataTables.min.js'); ?>