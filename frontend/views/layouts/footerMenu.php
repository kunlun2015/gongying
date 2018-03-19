<?php
/**
 * 底部菜单
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-03 11:01:53
 * @version $Id$
 */
    use yii\helpers\Url;
    use frontend\models\Message;
    $controllerId = Yii::$app->controller->id;
    $user = Yii::$app->session->get('user');
    $isHasNewMessage = (new Message)->isHasNewMessage($user['id']);
?>
<footer>
    <div class="menu<?php if($controllerId === 'site') echo ' active'; ?>"><a href="<?=Url::to(['/'])?>"><i class="fa fa-home"></i>首页</a></div>
    <div class="menu<?php if($controllerId === 'classify') echo ' active'; ?>"><a href="<?=Url::to(['/classify'])?>"><i class="fa fa-bars"></i>分类</a></div>
    <div class="menu<?php if($controllerId === 'purchase') echo ' active'; ?>"><a href="<?=Url::to(['/purchase'])?>"><i class="fa fa-window-restore"></i>求购</a></div>
    <div class="menu<?php if($controllerId === 'message') echo ' active'; ?>"><a href="<?=Url::to(['/message'])?>"><?php if($isHasNewMessage){ ?><span class="message-spot"></span><?php } ?><i class="fa fa-commenting-o"></i>消息</a></div>
    <div class="menu<?php if($controllerId === 'my') echo ' active'; ?>"><a href="<?=Url::to(['/my'])?>"><i class="fa fa-user"></i>我的</a></div>
</footer>