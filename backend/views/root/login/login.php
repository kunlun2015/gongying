<?php
/**
 * 用户登录
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-27 15:37:03
 * @version $Id$
 */
use backend\assets\RootAsset;
use yii\helpers\Html;
use yii\helpers\Url;  
RootAsset::register($this);
\backend\assets\RootAsset::addScript($this, 'static/pages/scripts/login.min.js');
$this->title = '管理员登录';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>        
        <link rel="shortcut icon" href="<?php echo Yii::$app->homeUrl; ?>favicon.ico" /> 
    </head>
    <body class=" login">
    <?php $this->beginBody() ?>
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="<?php echo Yii::$app->homeUrl; ?>static/pages/img/logo-big-white.png" style="height: 17px;" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="#" method="post">
                <div class="form-title">
                    <span class="form-title">管理员登录</span>
                    <!-- <span class="form-subtitle">管理员登录</span> -->
                </div>
                <div class="alert alert-danger display-hide return-msg">
                    <button class="close" data-close="alert"></button>
                    <span> 用户名和密码不能为空。 </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">用户名</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="用户名" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">密 码</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="登录密码" name="password" /> </div>
                <div class="form-actions">
                    <input type="submit" class="btn red btn-block uppercase" value="确 定" />
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme check">
                            <input type="checkbox" name="remember" value="1" />Remember me </label>
                    </div>
                </div>
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['root/login/check']); ?>">
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> 2017 © Kunlun </div>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
        <script src="<?php echo Yii::$app->homeUrl; ?>assets/global/plugins/respond.min.js"></script>
        <script src="<?php echo Yii::$app->homeUrl; ?>assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>