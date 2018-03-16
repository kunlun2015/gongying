<?php
/**
 * 消息页面
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-16 11:42:48
 * @version $Id$
 */
    $this->title = '消息';
    use yii\helpers\Url;
?>
<style>
    .weui-media-box__hd{position: relative;}
</style>
<div class="weui-panel weui-panel_access message-list">
    <div class="weui-panel__bd">
        <?php foreach ($list as $k => $v) {?>
        <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
                <img class="weui-media-box__thumb" src="<?=Yii::$app->params['imgUrl'].$v['avatar']?>" alt="">
                <span class="weui-badge" style="position: absolute;top: -.4em;right: -.4em;">8</span>
            </div>
            <div class="weui-media-box__bd">
                <h4 class="weui-media-box__title">
                    <?=$v['username']?>
                    <span class="weui-media-box__title-after"><?=$v['updated_at']?></span>
                </h4>
                <p class="weui-media-box__desc"><?=$v['last_message']?></p>
            </div>
        </a>
        <?php } ?>
    </div>
</div>
<?=$this->render('/layouts/footerMenu');?>