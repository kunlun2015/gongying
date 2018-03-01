<?php
/**
 * 用户信息
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 15:18:04
 * @version $Id$
 */
    $this->title = '用户首页';
    use yii\helpers\Url;    
    \backend\assets\RootAsset::addCss($this, 'static/pages/css/profile.min.css');
?>
<!-- END THEME PANEL -->
<h3 class="page-title"> 我的信息 | 账号管理
    <small>密码等信息的管理</small>
</h3>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo Yii::$app->homeUrl; ?>static/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> Marcus Doe </div>
                    <div class="profile-usertitle-job"> Developer </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                    <button type="button" class="btn btn-circle red btn-sm">Message</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="page_user_profile_1.html">
                                <i class="icon-home"></i> Overview </a>
                        </li>
                        <li class="active">
                            <a href="page_user_profile_1_account.html">
                                <i class="icon-settings"></i> 账户设置 </a>
                        </li>
                        <li>
                            <a href="page_user_profile_1_help.html">
                                <i class="icon-info"></i> Help </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div> 
            <!-- END PORTLET MAIN -->
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
                                    <a href="#tab_1_2" data-toggle="tab">设置头像</a>
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
                                    <form role="form" action="#">
                                        <div class="form-group">
                                            <label class="control-label">我的姓名</label>
                                            <input type="text" name="name" placeholder="请输入真实姓名" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">手机号码</label>
                                            <input type="text" name="phone" placeholder="您的手机号码" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">所在地区</label>
                                            <input type="text" name="area" placeholder="所在省市区" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">简介</label>
                                            <textarea name="abstract"  class="form-control" cols="30" rows="10" placeholder="您的简介"></textarea>
                                        </div>
                                        <div class="margiv-top-10">
                                            <a href="javascript:;" class="btn green"> 保存 </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. </p>
                                    <form action="#" role="form">
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="..."> </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">NOTE! </span>
                                                <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Submit </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
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
                                        <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['root/my/save']); ?>">
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
<?php \backend\assets\RootAsset::addScript($this, 'static/js/root/my.js'); ?>