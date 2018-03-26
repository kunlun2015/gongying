<?php
/**
 * 发布管理-编辑
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-26 10:20:44
 * @version $Id$
 */

$this->title = '发布管理-编辑';
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
                    <label class="col-md-2 control-label" for="form_control_1" style="text-align: right;">发布状态</label>
                    <div class="col-md-10">
                        <div class="md-radio-inline" style="margin-top: 0;">
                            <div class="md-radio">
                                <input type="radio" id="radio-1" name="status" value="1" class="md-radiobtn" <?php if($detail['status'] == 1){echo 'checked';} ?>>
                                <label for="radio-1" style="color: #F1C40F;">
                                    <span></span>
                                    <span class="check" style="background: #F1C40F;"></span>
                                    <span class="box" style="border-color: #F1C40F;"></span> 审核中 
                                </label>
                            </div>
                            <div class="md-radio">
                                <input type="radio" id="radio-2" name="status" value="2" class="md-radiobtn" <?php if($detail['status'] == 2){echo 'checked';} ?>>
                                <label for="radio-2" style="color: #36c6d3;">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box" style="border-color: #36c6d3;"></span> 审核通过 
                                </label>
                            </div>
                            <div class="md-radio has-error">
                                <input type="radio" id="radio-3" name="status" value="3" class="md-radiobtn" <?php if($detail['status'] == 3){echo 'checked';} ?>>
                                <label for="radio-3" style="color: #e73d4a;">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 审核未通过 
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="act" value="update">
                <input type="hidden" name="pid" value="<?=$detail['id']?>">
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
<input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['/published/save']); ?>">
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