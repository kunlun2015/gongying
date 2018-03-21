<?php
/**
 * 500页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-15 11:33:30
 * @version $Id$
 */
    $this->title = $errMsg.'-debugphp温馨提示';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addCss($this, 'css/style.css');
?>
<div class="wrap">
    <div class="tips-page page-500">
        <p>出错了</p>
    </div>
</div>