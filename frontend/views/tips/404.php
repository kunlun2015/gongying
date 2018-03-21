<?php
/**
 * 404页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-15 10:00:12
 * @version $Id$
 */

    $this->title = $errMsg.'-debugphp温馨提示';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addCss($this, 'css/style.css');
?>
<div class="wrap">
    <div class="tips-page page-404">
        <img class="icon-404" src="<?=Yii::$app->params['staticUrl']?>/images/404.png" alt="404">
        <img class="icon-404-gif" src="<?=Yii::$app->params['staticUrl']?>/images/404-gif.gif" alt="404">
        <p>SORRY你要访问的页面找不到了</p>
    </div>
</div>