<?php
/**
 * 反馈管理
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 14:06:20
 * @version $Id$
 */

$this->title = '反馈管理-列表';
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
            <a href="<?php echo Url::to(['/feedback']); ?>">反馈管理</a>
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
                    <span class="caption-subject bold uppercase"> 反馈管理 </span>
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
                               
                            </select>
                        </label>                        
                    </div>
                    </form>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="list-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> 用户 </th>
                            <th> 反馈内容 </th>
                            <th> 处理状态 </th>
                            <th> 反馈时间 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) {?>
                        <tr>
                            <td><?=$v['id']?></td>
                            <td><?=$v['username']?></td>
                            <td><?=$v['content']?></td>
                            <td>
                                <?php
                                    if($v['status'] == 0){
                                        echo '<span class="label label-sm label-warning"> 待回复 </span>';
                                    }elseif($v['status'] == 1){
                                        echo '<span class="label label-sm label-success"> 已回复 </span>';
                                    }
                                ?>
                            </td>
                            <td><?=$v['created_at']?></td>
                            <td>
                                <a href="<?=Url::to(['/feedback/reply', 'id' => $v['id']])?>">回复</a>
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
                targets: [5]
            }],
            order: []
        });
    })    
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/scripts/datatable.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/datatables/jquery.dataTables.min.js'); ?>