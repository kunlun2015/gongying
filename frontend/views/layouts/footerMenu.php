<?php
/**
 * 底部菜单
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-03 11:01:53
 * @version $Id$
 */
    use yii\helpers\Url;
?>
<footer>
    <div class="menu<?php if(Yii::$app->controller->id === 'site') echo ' active'; ?>"><a href="<?=Url::to(['/'])?>"><i class="fa fa-home"></i>首页</a></div>
    <div class="menu"><a href=""><i class="fa fa-bars"></i>分类</a></div>
    <div class="menu"><a href="<?=Url::to(['/purchase'])?>"><i class="fa fa-window-restore"></i>求购</a></div>
    <div class="menu"><a href=""><i class="fa fa-commenting-o"></i>消息</a></div>
    <div class="menu"><a href="<?=Url::to(['/my'])?>"><i class="fa fa-user"></i>我的</a></div>
</footer>