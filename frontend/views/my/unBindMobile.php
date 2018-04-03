<?php
/**
 * 绑定手机号码
 * @authors Amos (735767227@qq.com)
 * @date    2018-04-03 13:25:15
 * @version $Id$
 */
    $this->title = '解绑手机号码';
    use yii\helpers\Url;
?>
<div class="bind-mobile-form">
    <form action="">
    <div class="weui-cells weui-cells_form">    
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd">
                <label class="weui-label">手机号</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="mobile" value="<?=$mobile?>" readonly type="tel" placeholder="请输入手机号">
            </div>
            <div class="weui-cell__ft">
                <button class="weui-vcode-btn"><span></span>获取验证码</button>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="code" type="number" pattern="[0-9]*" placeholder="请输入短信验证码">
            </div>
        </div>    
    </div>
    </form>
    <a href="javascript:;" class="weui-btn weui-btn_primary save-btn">确定</a>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        $('.weui-vcode-btn').click(function(){
            var _this = $(this);
            if(!tools.validate.mobile($('input[name="mobile"]').val())){
                $.alert("手机号码格式不正确", function(){
                    $('input[name="mobile"]').focus();
                });
                return false;
            }
            _this.attr('disabled', true);
            var count = 30;
            var timer = null;
            timer = setInterval(function () {
                    if (count > 0) {
                        count = count - 1;
                        $('.weui-vcode-btn span').text('('+count+')');
                    }else {
                       $('.weui-vcode-btn span').text('');
                       _this.attr('disabled', false);
                       clearInterval(timer);
                   }
                }, 1000);
            return false;
        })

        $('.save-btn').click(function(){
            var _this = $(this);
            if(_this.hasClass('disabled')){
                return false;
            }
            if(!tools.validate.mobile($('input[name="mobile"]').val())){
                $.alert("手机号码格式不正确", function(){
                    $('input[name="mobile"]').focus();
                });
                return false;
            }
            if(!$("input[name=code]").val()){
                $.alert("验证码不能为空", function(){
                    $('input[name="code"]').focus();
                });   
            }
            tools.ajax({
                url: '<?=Url::to(['/my/unbind-mobile'])?>',
                type: 'post',
                dataType: 'json',
                data: $("form").serialize(),
                beforeSend: function(){
                    _this.addClass('disabled');
                },
                success: function(res){
                    if(res.code === 0){
                        $.toast(res.msg, 1000, function(){
                            window.location.href = res.data.url;
                        });
                    }else{
                        _this.removeClass('disabled');
                        $.toast(res.msg, 'cancel');
                    }
                },
                error: function(){
                    _this.removeClass('disabled');
                }
            })
            return false;
        })
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>