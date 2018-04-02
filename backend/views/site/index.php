<?php

/* @var $this yii\web\View */

$this->title = '后台首页';
use yii\helpers\Url;
?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<h3 class="page-title"> 后台首页
    <small>统计全局重要信息</small>
</h3>
<div class="note note-info">
    <p> 您可以在这里查看应用的统计信息 </p>
</div>
