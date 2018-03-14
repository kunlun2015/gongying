<?php
/**
 * 消息详情
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-14 09:46:54
 * @version $Id$
 */
    $this->title = '与XX对话';
    use yii\helpers\Url;
?>
<div class="chat">
    <div class="message">
        <div class="avatar">
            <img src="http://c1.mifile.cn/f/i/hd/2016051101/a-wc.png" alt="">
        </div>
        <div class="content">
            <p class="author-name">小米电视王川</p>
            <div class="message-text-wrap left">
                <div class="message-text">你好！</div>
            </div>
        </div>
    </div>
    <div class="message">
        <div class="avatar">
            <img src="http://c1.mifile.cn/f/i/hd/2016051101/a-wc.png" alt="">
        </div>
        <div class="content">
            <p class="author-name">小米电视王川</p>
            <div class="message-text-wrap left">
                <div class="message-text">
                    你好！
                </div>
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
    </div>
</div>
<div class="input-text">
    <input type="text" placeholder="请输入您要咨询的内容"><input type="button" value="发送">
</div>