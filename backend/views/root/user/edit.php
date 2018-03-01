<?php
/**
 * 编辑用户
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 17:48:33
 * @version $Id$
 */
    $this->title = '编辑用户';
    use yii\helpers\Url; 
?>
<h3 class="page-title"> 用户管理
    <small>登录用户添加、修改等</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo Url::to(['root/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['root/user']); ?>">用户管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>编辑用户</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
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
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">编辑用户</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal edit-user-form" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">用户名</label>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control input-inline input-medium" placeholder="登录用户名" readonly="readonly" value="<?php echo $user_info['username']; ?>">
                                <input type="hidden" name="uid" value="<?php echo $user_info['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">真实姓名</label>
                            <div class="col-md-9">
                                <input type="text" name="realname" class="form-control input-inline input-medium" placeholder="真实姓名" value="<?php echo $user_info['realname']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">手机号码</label>
                            <div class="col-md-9">
                                <input type="text" name="mobile" value="<?php echo $user_info['mobile']; ?>" class="form-control input-inline input-medium" placeholder="手机号码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">备注</label>
                            <div class="col-md-9">
                                <textarea name="remarks" cols="30" rows="4" class="form-control" placeholder="备注信息"><?php echo $user_info['remarks']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">用户状态</label>
                            <div class="col-md-9">
                                <div class="icheck-inline">
                                    <label>
                                        <input type="radio" name="status" value="0" <?php if($user_info['status'] == 0) echo 'checked'; ?> class="icheck" data-radio="iradio_square-grey"> 正常 
                                    </label>
                                    <label>
                                        <input type="radio" name="status" value="1" <?php if($user_info['status'] == 1) echo 'checked'; ?> class="icheck" data-radio="iradio_square-grey"> 禁用 
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">确 定</button>
                                <button type="button" class="btn default history-back">取 消</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="act" value="edit">
                    <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['root/user/action']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<?php \backend\assets\RootAsset::addScript($this, 'static/js/root/user.js'); ?>