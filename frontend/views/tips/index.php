<?php
/**
 * 提示页
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-13 12:00:51
 * @version $Id$
 */
    $this->title = $title.'-debugphp温馨提示';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addCss($this, 'css/style.css');
?>
<div class="weui-msg">
    <div class="weui-msg__icon-area"><i class="<?=$icon?> weui-icon_msg"></i></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title"><?=$title?></h2>
        <p class="weui-msg__desc"><?=$msg?></p>
    </div>
</div>
<?php $this->beginBlock('tipsJs'); ?>
$(document).ready(function(){
    var timeout = <?=isset($timeout) ? $timeout : 0?>;
    <?php if($autoRedirect === true && isset($redirect) && $redirect === true){ ?>
    timer = setInterval(function () {
        if (timeout > 1) {
            timeout = timeout - 1;
            $('.timeout').text(timeout);
        }else {
           clearInterval(timer);
           <?php if(isset($redirectUrl) && $redirectUrl){ ?>
           window.location.href = '<?=$redirectUrl?>';
           <?php }else{ ?>
           history.back();
           <?php } ?>
       }
    }, 1000);
    <?php } ?>
})
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['tipsJs'], \yii\web\View::POS_END); ?>