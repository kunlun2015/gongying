<?php
/**
 * 我的页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 21:53:52
 * @version 1.0
 */
    $this->title = '我的';
    use yii\helpers\Url;
?>
<div class="weui-cells">
    <a href="<?=Url::to(['/my/profile'])?>"  class="weui-cell weui-cell_access">
        <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
            <img src="./static/images/pic_160.png" style="width: 50px;display: block">
        </div>
        <div class="weui-cell__bd">
            <p>Amos</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a href="" class="weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">我的发布</span>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a href="" class="weui-cell weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">我的收藏</span>            
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a href="" class="weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">反馈意见</span>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a href="" class="weui-cell weui-cell_access">
        <div class="weui-cell__bd">
            <span style="vertical-align: middle">关于我们</span>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
</div>
<?=$this->render('/layouts/footerMenu');?>