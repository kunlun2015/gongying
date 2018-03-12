<?php
/**
 * 选择头像
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-12 14:46:18
 * @version $Id$
 */
    $this->title = '选择头像';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addCss($this, 'libs/cropper/cropper.css');
    \frontend\assets\AppAsset::addScript($this, 'libs/cropper/cropper.js');
    \frontend\assets\AppAsset::addScript($this, 'libs/cropper/jquery-cropper.min.js');
?>
<style>

</style>
<div class="wrap">
    <div class="select-avatar-container">
        <img id="image" src="">
    </div>
    <div class="img-preview"></div>
    <input type="button" class="weui-btn weui-btn_plain-default select-avatar" value="选择头像">
    <input type="button" class="weui-btn weui-btn_primary save-avatar" value="保存头像">
    <input type="file" class="none">
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        var $image = $('#image');

        $('.select-avatar').click(function(){
            $('input[type="file"]').trigger('click');
            return false;
        })

        $("input[type=file]").change(function(){
            var file = this.files[0];            
            $('#image').attr('src', URL.createObjectURL(file));
            $image.cropper({
                aspectRatio: 1 / 1,
                preview: '.img-preview',
                cropBoxResizable: false,
                crop: function(event) {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
              }
            });
            return false;
        })

        $('.save-avatar').click(function(){
            var imgData=$image.cropper('getCroppedCanvas', {width: 120, heidht: 120})
            var dataurl = imgData.toDataURL('image/png');
            tools.ajax({
                url: '/my/save-avatar',
                dataType: 'json',
                type: 'post',
                data: {base64: dataurl},
                success: function(res){
                    if(res.code === 0){
                        $.toast(res.msg, 1000, function(){
                            window.location.href = res.data.url;
                        });
                    }else{
                        $.toast(res.msg, 'cancel');
                    }
                }
            })
        })
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>