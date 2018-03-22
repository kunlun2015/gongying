<?php
/**
 * 修改资料
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-19 17:40:00
 * @version $Id$
 */

    $this->title = '修改资料';
    use yii\helpers\Url;
?>
<form action="">
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="username" value="<?=$user['username']?>" type="text" placeholder="请输入您的姓名">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">手机号码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="mobile" value="<?=$user['mobile']?>" type="text" placeholder="请输入您的手机号码">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">所在公司</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="company" value="<?=$user['company']?>" type="text" placeholder="所在公司名称">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">职位</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" name="position" value="<?=$user['position']?>" type="text" placeholder="您的职位">
        </div>
    </div>
    <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
</div>
<a href="javascript:;" class="weui-btn weui-btn_primary mt-50 save-btn" style="width: 90%;">保存</a>
</form>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        var backUrl = '<?=$backUrl?>';     
        $('.save-btn').click(function(){
            if(!$('input[name="username"]').val()){
                $.alert("姓名不能为空", function(){
                    $('input[name="username"]').focus();
                });
                return false;
            }
            if(!tools.validate.mobile($('input[name="mobile"]').val())){
                $.alert("手机号码格式不正确", function(){
                    $('input[name="mobile"]').focus();
                });
                return false;
            }
            tools.ajax({
                url: '',
                type: 'post',
                dataType: 'json',
                data: $("form").serialize(),
                success: function(res){
                    if(res.code === 0){
                        $.toast(res.msg, 1000, function(){
                            window.location.href = backUrl ? backUrl : res.data.url;
                        });
                    }else{
                        $.toast(res.msg, 'cancel');
                    }
                }
            })
            return false;
        })
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>