<?php
/**
 * 反馈意见-新增反馈
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 09:35:59
 * @version $Id$
 */
    $this->title = '反馈意见-新增反馈';
    use yii\helpers\Url;
?>
<style>
    .weui-btn{width: 90%;margin-top: 40px;}
</style>
<div class="weui-cells__title">反馈内容</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea name="content" class="weui-textarea" placeholder="请输入反馈内容" rows="5"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/500</div>
        </div>
    </div>
</div>
<a href="javascript:;" class="weui-btn weui-btn_primary">确 定</a>
<?php $this->beginBlock("pageJs") ?>
$(document).ready(function(){
    $("textarea[name='content']").on('input', function(){
        var counter = $('.weui-textarea-counter')[0].innerText;
        var counterLength = counter.split('/');
        var curLength = Number($("textarea[name='content']").val().length);
        var totalLength = Number(counterLength[1]);
        $('.weui-textarea-counter')[0].innerText = curLength+'/'+totalLength;
        if(curLength > totalLength){
            $('.weui-textarea-counter')[0].innerText = totalLength+'/'+totalLength;
            $("textarea[name='content']").val($("textarea[name='content']").val().substr(0, totalLength));
            return false;
        }
    })
    $('.weui-btn').click(function(){
        var content = $("textarea[name='content']").val();
        if(!content){
            $.alert("请输入要反馈的内容", function(){
                $("textarea[name='content']").focus()
            });
            return false;
        }
        tools.ajax({
            url: '/feedback/save',
            dataType: 'json',
            type: 'post',
            data: {content: content, '<?= \Yii::$app->request->csrfParam; ?>': '<?= \Yii::$app->request->getCsrfToken();?>'},
            success: function(res){
                if(res.code === 0){
                    $.toast(res.msg, 1000, function(){
                        window.location.href = res.data.url
                    });
                }
            }
        })
        return false;
    })
})
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>