<?php
/**
 * 用户信息展示
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-22 15:28:17
 * @version $Id$
 */

    $this->title = '用户管理-用户信息展示';
    use yii\helpers\Url;
    \backend\assets\AppAsset::addCss($this, 'static/pages/css/profile-2.min.css');
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
                                    <div class="col-md-1">
                                        <ul class="list-unstyled profile-nav">
                                            <li>
                                                <img src="<?=Yii::$app->params['imgUrl'].$user['avatar']?>" class="img-responsive pic-bordered" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col-md-8 profile-info">
                                                <h1 class="font-green sbold uppercase"><?=$user['username']?></h1>
                                                <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.
                                                    </p>
                                                <p>
                                                    <a href="javascript:;"> www.mywebsite.com </a>
                                                </p>
                                                <ul class="list-inline">
                                                    <li>注册时间：<?=$user['created_at']?></li>
                                                    <li>登陆次数：<?=$user['login_times']?></li>
                                                    <li>上次登陆时间：<?=$user['last_login_time']?></li>
                                                </ul>
                                            </div>
                                            <!--end col-md-8-->
                                            <div class="col-md-4">
                                                <div class="portlet sale-summary">
                                                    <div class="portlet-title">
                                                        <div class="caption font-red sbold"> 个人资料 </div>
                                                        <div class="tools">
                                                            <a class="reload" href="javascript:;" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <span class="sale-info">手机号码</span>
                                                                <span class="sale-num"> <?=$user['mobile']?> </span>
                                                            </li>
                                                            <li>
                                                                <span class="sale-info">所在公司</span>
                                                                <span class="sale-num"> <?=$user['company']?> </span>
                                                            </li>
                                                            <li>
                                                                <span class="sale-info"> 职位 </span>
                                                                <span class="sale-num"> <?=$user['position']?> </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-md-4-->
                                        </div>
                                        <!--end row-->                                        
                                    </div>
                                </div>
                                <div class="row" style="display: none;">
                                    <div class="tabbable-line tabbable-custom-profile">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1" data-toggle="tab" aria-expanded="true"> 他的求购 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_2" data-toggle="tab" aria-expanded="false"> 他的供应 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_3" data-toggle="tab" aria-expanded="false"> 他的收藏 </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                1
                                            </div>                                            
                                            <div class="tab-pane" id="tab_2">
                                                2
                                            </div>
                                            <div class="tab-pane" id="tab_3">
                                                3
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['/user/save']); ?>">
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>