<?php
/**
 * 前端通用布局
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-06 14:26:21
 * @version $Id$
 */
use yii\helpers\Html;
use yii\helpers\Url;
\frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="copyright" content="Copyright 2018-<?=date('Y')?>. www.xxx.com . All Rights Reserved." />
    <meta name="application-name" content="" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>    
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php echo $this->render('footer')?>
</body>
</html>
<?php $this->endPage() ?>