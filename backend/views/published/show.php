<?php
/**
 * 查看发布内容
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 11:54:06
 * @version $Id$
 */
    $this->title = '查看发布内容';
    use yii\helpers\Url;
    \backend\assets\AppAsset::addCss($this, 'static/pages/css/profile-2.min.css');
?>
<style>
    .pictures>img{margin-top: 10px;display: block;}
</style>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/manage']); ?>">发布管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a>查看</a>
        </li>      
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 查看 </span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="list-table">
                                        <tr>
                                            <td width="100">标题</td>
                                            <td><?=$detail['title']?></td>
                                        </tr>
                                        <tr>
                                            <td>发布用户</td>
                                            <td><?=$detail['username']?></td>
                                        </tr>
                                        <tr>
                                            <td>发布类型</td>
                                            <td>
                                                <?php
                                                    if($detail['type'] == 1){
                                                        echo '求购';
                                                    }elseif($detail['type'] == 2){
                                                        echo '供应';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php if($detail['type'] == 1){ ?>
                                        <tr>
                                            <td>数量</td>
                                            <td><?=$detail['num']?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>所属分类</td>
                                            <td><?=$detail['fname']?> > <?=$detail['sname']?> > <?=$detail['tname']?></td>
                                        </tr>
                                        <?php if($detail['type'] == 1){ ?>
                                        <tr>
                                            <td>预算金额</td>
                                            <td><?=$detail['budget']?></td>
                                        </tr>
                                        <tr>
                                            <td>交付周期</td>
                                            <td><?=$detail['delivery_cycle']?></td>
                                        </tr>
                                        <tr>
                                            <td>截至日期</td>
                                            <td><?=$detail['deadline']?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><?php if($detail['type'] == 1){echo '交付';}elseif($detail['type'] == 2){echo '所在';} ?>地区</td>
                                            <td><?=$detail['delivery_area']?></td>
                                        </tr>
                                        <tr>
                                            <td>描述说明</td>
                                            <td>
                                                <?=$detail['description']?>
                                                <div class="pictures">
                                                    <?php foreach ($detail['pictures'] as $k => $v) {?>
                                                    <img src="<?=Yii::$app->params['imgUrl'].$v?>" alt="">
                                                    <?php } ?>
                                                </div>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>是否匿名发布</td>
                                            <td>
                                                <?php
                                                    if($detail['anonymous'] == 1){
                                                        echo '是';
                                                    }else{
                                                        echo '否';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <a href="javascript:history.back();" class="btn default btn-block"> 返回 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>