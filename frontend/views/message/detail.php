<?php
/**
 * 消息详情
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-14 09:46:54
 * @version $Id$
 */
    $this->title = '与'.$toUser['username'].'对话';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addScript($this, 'js/message.js');
?>
<div class="chat">
    <!-- <div class="message">
        <div class="avatar">
            <img src="<?=Yii::$app->params['imgUrl'].$toUser['avatar']?>" alt="">
        </div>
        <div class="content">
            <p class="author-name"><?=$toUser['username']?></p>
            <div class="message-text-wrap left">
                <div class="message-text">你好！</div>
            </div>
        </div>
    </div>
    <div class="message me">
        <div class="avatar">
            <img src="http://c1.mifile.cn/f/i/hd/2016051101/a-wc.png" alt="">
        </div>
        <div class="content">
            <p class="author-name">小米电视王川</p>
            <div class="message-text-wrap">
                <div class="message-text">
                    你好！
                </div>
            </div>
        </div>
    </div> -->
    <?php foreach ($message as $k => $v) {?>
    <div class="message<?php if($v['suid'] == $user['id']) echo ' me'; ?>">
        <div class="avatar">
            <img src="<?=Yii::$app->params['imgUrl'].$v['avatar']?>" alt="">
        </div>
        <div class="content">
            <p class="author-name"><?=$v['username']?></p>
            <div class="message-text-wrap left">
                <div class="message-text"><?=$v['message_text']?></div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<div class="weui-cell weui-cell_vcode send-input">
    <div class="weui-cell__bd">
        <input class="weui-input message-input" type="text" placeholder="请输入您要发送的内容">
        <input type="hidden" name="tuid" value="<?=$toUser['id']?>">
        <input type="hidden" name="rid">
        <input type="hidden" name="username" value="<?=$user['username']?>">
        <input type="hidden" name="avatar" value="<?=Yii::$app->params['imgUrl'].$user['avatar']?>">
    </div>
    <div class="weui-cell__ft">
        <button class="weui-vcode-btn btn-send">发送</button>
    </div>
</div>