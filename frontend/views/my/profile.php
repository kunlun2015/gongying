<?php
/**
 * 我的资料
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-04 15:38:46
 * @version 1.0
 */
    $this->title = '我的资料';
    use yii\helpers\Url;
?>
<div class="avatar">
    <img src="<?=Yii::$app->params['imgUrl'].$user['avatar']?>">
</div>
<div class="weui-cells">
    <a href="<?=Url::to(['/my/select-avatar'])?>" class="weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">修改头像</span>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a href="<?=Url::to(['/my/bind-mobile'])?>" class="weui-cell weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">绑定/解绑手机号码</span>            
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a href="<?=Url::to(['/my/edit-profile'])?>" class="weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">资料修改</span>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
</div>