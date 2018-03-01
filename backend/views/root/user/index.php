<?php
/**
 * 用户管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 14:06:47
 * @version $Id$
 */
    $this->title = '用户管理';
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
            <span>用户管理</span>
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
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 用户管理 </span>
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
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="<?php echo Url::to(['root/user/add']); ?>" class="btn sbold green"> 添加用户
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                            <th> 用户名 </th>
                            <th> 真实姓名 </th>
                            <th> 登录次数 </th>
                            <th> 上次登录时间 </th>
                            <th> 状态 </th>
                            <th> 操作 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $k => $v) { ?>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1" /> </td>
                            <td> <?php echo $v['username']; ?> </td>
                            <td> <?php echo $v['realname']; ?> </td>
                            <td> <?php echo $v['login_times']; ?> </td>
                            <td class="center"> <?php echo $v['last_login_time']; ?>  </td>
                            <td> 
                                <?php if($v['status'] == 0){ ?>
                                <span class="label label-sm label-success"> 正常 </span>
                                <?php }else if($v['status'] == 1){ ?> 
                                <span class="label label-sm label-warning"> 禁用 </span>
                                <?php } ?>
                            </td>
                            <td class="table-opt-td">
                                <a href="<?php echo Url::to(['root/user/edit', 'uid' => $v['id']]); ?>">编辑</a>
                                <a href="<?php echo Url::to(['root/user/authority', 'uid' => $v['id']]); ?>">权限</a>
                                <a href="">删除</a>
                            </td>
                        </tr>
                        <?php } ?>                                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php \backend\assets\RootAsset::addScript($this, 'static/js/root/user.js'); ?>