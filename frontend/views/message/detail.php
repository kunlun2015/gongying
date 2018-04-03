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
<?php if($rid){ ?><a href="javascript:;" data-page="1" data-total="<?=$totalPage?>" class="more-message-btn">点击查看历史消息</a><?php } ?>
<div class="chat">
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
        <input type="hidden" name="rid" value="<?=$rid?>">
        <input type="hidden" name="username" value="<?=$user['username']?>">
        <input type="hidden" name="avatar" value="<?=Yii::$app->params['imgUrl'].$user['avatar']?>">
    </div>
    <div class="weui-cell__ft">
        <button class="weui-vcode-btn btn-send">发送</button>
    </div>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        <?php if($rid){ ?>
        $('.more-message-btn').click(function(){
            var _this = $(this);
            var page = _this.data('page');
            var total = _this.data('total');
            if(page >= total || _this.hasClass('loading')){
                return false;
            }
            tools.ajax({
                url: '<?=Url::to(['/message/list'])?>',
                type: 'get',
                dataType: 'json',
                data: {rid: <?=$rid?>, page: page + 1},
                beforeSend: function(){
                    _this.addClass('loading');
                    _this.text('正在加载...');
                },
                success: function(res){
                    if(res.code == 0){
                        var html = '';
                        var isMe = '';
                        $.each(res.data, function(index, value){
                            isMe = value.suid == <?=$user['id']?> ? 'me' : '';
                            html += '<div class="message '+isMe+'"><div class="avatar"><img src="<?=Yii::$app->params['imgUrl']?>'+value.avatar+'" alt=""></div><div class="content"><p class="author-name">'+value.username+'</p><div class="message-text-wrap left"><div class="message-text">'+value.message_text+'</div></div></div></div>';
                            $('.chat').prepend(html);
                            if(page + 1 >= total){
                                $('.more-message-btn').remove();
                            }else{
                                _this.text('点击查看历史消息');
                                _this.removeClass('loading');
                                $('.more-message-btn').data('page', page + 1);
                            }
                        })
                    }else{

                    }
                }
            })
            return false;
        })
        <?php } ?>
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>