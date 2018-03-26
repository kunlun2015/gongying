<?php
/**
 * 编辑用户
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-22 09:24:52
 * @version $Id$
 */
$this->title = '用户管理-编辑用户';
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
        <li>
            <a>编辑</a>
        </li>      
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 编辑 </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="page-form">             
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1" style="text-align: right;">用户状态</label>
                    <div class="col-md-10">
                        <div class="md-radio-inline" style="margin-top: 0;">
                            <div class="md-radio">
                                <input type="radio" id="radio-1" name="status" value="1" class="md-radiobtn"<?php if($user['status'] == 1){echo ' checked';} ?>>
                                <label for="radio-1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 正常 
                                </label>
                            </div>
                            <div class="md-radio has-error">
                                <input type="radio" id="radio-2" name="status" value="2" class="md-radiobtn"<?php if($user['status'] == 2){echo ' checked';} ?>>
                                <label for="radio-2" style="color: #e73d4a;">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 禁用
                                 </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="act" value="update">
                <input type="hidden" name="suid" value="<?=$user['id']?>">
                <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                </form>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="button" class="btn default"> 取消 </button>
                            <button type="button" class="btn blue btn-submit"> 保存 </button>
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
        $('.btn-submit').click(function(){
            $.ajax({
                url: $("input[name='request_url']").val(),
                type: 'post',
                dataType: 'json',               
                data: $('.page-form').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            history.back();
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
            return false;
        })
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>