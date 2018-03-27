<?php
/**
 * 反馈管理-回复
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 14:50:30
 * @version $Id$
 */

$this->title = '反馈管理-回复';
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
            <a href="<?php echo Url::to(['/feedback']); ?>">反馈管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a>回复</a>
        </li>      
    </ul>
</div>
<style>
    .feedback-wrap .avatar{width: 45px;height: 45px;overflow: hidden;border-radius: 45px !important;float: left;}
    .feedback-wrap .avatar img{width: 45px;}
    .feedback-wrap .user{overflow: hidden;}
    .feedback-wrap .user span{display: inline-block;float: left;font-size: 28px;font-weight: bold;margin: 10px 0 0 10px;}
    .feedback-wrap .user em{display: inline-block;font-style: normal;margin: 25px 0 0 20px;}
    .feedback-wrap .well{margin: 10px 0 0 45px;}
    .reply-box{margin: 20px 0 0 45px;}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> 反馈管理-回复 </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="feedback-wrap">
                    <div class="user">
                        <div class="avatar">
                            <img src="<?=Yii::$app->params['imgUrl'].$detail['avatar']?>" alt="<?=$detail['username']?>">
                        </div>
                        <span><?=$detail['username']?></span>
                        <em><?=$detail['created_at']?></em>
                    </div>
                    <div class="well"> <?=$detail['content']?> </div>
                    <div class="reply-box">
                        <textarea class="form-control todo-taskbody-taskdesc reply-text" rows="4" placeholder="请输入回复内容"><?=$detail['reply']?></textarea>
                    </div>
                    <button type="button" class="pull-right btn btn-sm btn-circle green btn-submit" style="margin-top: 10px;"> &nbsp; 确定 &nbsp; </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        $('.btn-submit').click(function(){
            var reply = $('.reply-text').val();
            if(!reply){
                layer.alert('回复内容不能为空', {title: siteName+'提示您：', icon: 1}, function(index){
                    $('.reply-text').focus();
                    layer.close(index);
                });
                return false;
            }
            $.ajax({
                url: '',
                type: 'post',
                dataType: 'json',
                data: {id: <?=$detail['id']?>,reply: reply, '<?= \Yii::$app->request->csrfParam; ?>': '<?= \Yii::$app->request->getCsrfToken();?>'},
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