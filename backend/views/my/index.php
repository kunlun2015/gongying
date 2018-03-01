<?php
/**
 * 账户信息管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-20 14:39:01
 * @version $Id$
 */

$this->title = '我的账户';
use yii\helpers\Url;
\backend\assets\AppAsset::addCss($this, 'static/pages/css/profile.min.css');
\backend\assets\AppAsset::addCss($this, 'static/global/plugins/img-crop/cropper.min.css');
\backend\assets\AppAsset::addCss($this, 'static/global/plugins/img-crop/mycrop.css');
?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>我的账户</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-shield"></i> Another action</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user"></i> Something else here</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-bag"></i> Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<h3 class="page-title"> 个人中心
    <small>更新个人账户信息</small>
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php if(Yii::$app->session->get('user')['avatar']){echo Yii::$app->params['imgUrl'].Yii::$app->session->get('user')['avatar'];}else{echo Yii::$app->params['defaultAvatar'];} ?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?=$myInfo['username']?> </div>
                    <div class="profile-usertitle-job"> <?=$myInfo['realname']?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="page_user_profile_1_account.html">
                                <i class="icon-settings"></i> 账户设置 </a>
                        </li>
                        <li>
                            <a href="page_user_profile_1_help.html">
                                <i class="icon-info"></i> 帮助反馈 </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <div class="portlet light ">
                <!-- STAT -->
                <div class="row list-separated profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 100 </div>
                        <div class="uppercase profile-stat-text"> 项目1 </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 51 </div>
                        <div class="uppercase profile-stat-text"> 项目2 </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 61 </div>
                        <div class="uppercase profile-stat-text"> 项目3 </div>
                    </div>
                </div>
                <!-- END STAT -->
                <div>
                    <h4 class="profile-desc-title">登录信息</h4>
                    <span class="profile-desc-text"> 记录上次账户登录信息 </span>
                    <div class="margin-top-20 profile-desc-link">登录次数：<?=$myInfo['login_times']?>
                    </div>
                    <div class="margin-top-20 profile-desc-link">登录时间：<?=$myInfo['last_login_time']?>
                    </div>
                    <div class="margin-top-20 profile-desc-link">登录地点：<?=$address?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">我的信息</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">基本信息</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">修改密码</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" action="#" class="basic-info-form">
                                        <div class="form-group">
                                            <label class="control-label">我的姓名</label>
                                            <input type="text" name="realname" value="<?=$myInfo['realname']?>" placeholder="请输入真实姓名" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">手机号码</label>
                                            <input type="text" name="mobile" value="<?=$myInfo['mobile']?>" placeholder="您的手机号码" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">所在地区</label>
                                            <input type="text" name="area" placeholder="所在省市区" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">简介</label>
                                            <textarea name="remarks"  class="form-control" cols="30" rows="10" placeholder="您的简介"><?=$myInfo['remarks']?></textarea>
                                        </div>
                                        <div class="margiv-top-10">
                                            <input type="Submit" class="btn green" value="保 存">
                                        </div>
                                        <input type="hidden" name="act" value="editMyInfo">
                                        <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                                        <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['my/save']); ?>">
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="#" id="edit-password">
                                        <div class="form-group">
                                            <label class="control-label">原密码</label>
                                            <input type="password" name="password_old" class="form-control" placeholder="您的当前登录密码" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">新密码</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="新密码" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">确认新密码</label>
                                            <input type="password" name="password_confirm" class="form-control" placeholder="确认新密码" />
                                        </div>
                                        <div class="margin-top-10">
                                            <input type="Submit" class="btn green" value="保 存">
                                        </div>
                                        <input type="hidden" name="act" value="password">
                                        <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                                        <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['my/save']); ?>">
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<div class="modal fade" id="avatarEditModal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">修改头像</h4>
            </div>
            <div class="modal-body">
                <div class="avatar-body">
                    <form action="" class="avatar-form">
                    <div class="avatar-upload">                        
                        <label for="avatarInput" style="line-height: 35px;">图片上传</label>
                        <button class="btn btn-danger"  type="button" style="height: 35px;" onClick="$('input[id=avatarInput]').click();">请选择图片</button>
                        <span id="avatar-name"></span>
                        <input class="avatar-input hide" id="avatarInput" name="avatar_file" type="file"></div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="avatar-wrapper"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="avatar-preview preview-lg" id="imageHead"></div>
                        </div>
                    </div>
                    <div class="row avatar-btns">
                        <div class="col-md-4">
                            <div class="btn-group">
                                <button class="btn btn-danger fa fa-undo" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"> 向左旋转</button>
                            </div>
                            <div class="btn-group">
                                <button class="btn  btn-danger fa fa-repeat" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"> 向右旋转</button>
                            </div>
                        </div>
                        <div class="col-md-5" style="text-align: right;">                               
                            <button class="btn btn-danger fa fa-arrows" data-method="setDragMode" data-option="move" type="button" title="移动">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                            </span>
                          </button>
                          <button type="button" class="btn btn-danger fa fa-search-plus" data-method="zoom" data-option="0.1" title="放大图片">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, 0.1)">
                              <!--<span class="fa fa-search-plus"></span>-->
                            </span>
                          </button>
                          <button type="button" class="btn btn-danger fa fa-search-minus" data-method="zoom" data-option="-0.1" title="缩小图片">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, -0.1)">
                              <!--<span class="fa fa-search-minus"></span>-->
                            </span>
                          </button>
                          <button type="button" class="btn btn-danger fa fa-refresh" data-method="reset" title="重置图片">
                                <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;reset&quot;)" aria-describedby="tooltip866214">
                           </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-danger btn-block avatar-save fa fa-save" type="button"> 保存修改</button>
                        </div>
                    </div>
                    <input type="hidden" name="act" value="uploadAvatar">
                    <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                    <input disabled="disabled" type="hidden" name="avatar_request_url" value="<?php echo Url::to(['my/save']); ?>">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">取消</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/img-crop/cropper.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/img-crop/mycrop.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/global/plugins/img-crop/html2canvas.min.js'); ?>
<?php \backend\assets\AppAsset::addScript($this, 'static/js/my.js'); ?>
