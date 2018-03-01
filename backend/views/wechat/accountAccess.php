<?php
/**
 * 查看账号接入信息
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-03 16:33:31
 * @version $Id$
 */

$this->title = '微信管理-账号接入';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/otags']); ?>">微信管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>账号接入</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">账号接入</span>
                </div>
            </div>
            <div class="portlet-body form">
                <h4 class="block">接口URL:</h4>
                <div class="well">http://test.debugphp.com/wechat/api?id=<?=$detail['id']?></div>
                <h4 class="block">Token:</h4>
                <div class="well"><?=$token?></div>
            </div>
        </div>
    </div>
</div>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/wechat.js'); ?>