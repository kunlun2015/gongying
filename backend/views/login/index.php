<?php
/**
 * 用户登录页面
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-06 15:43:11
 * @version $Id$
 */
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;  
AppAsset::register($this);
\backend\assets\AppAsset::addCss($this, 'static/pages/css/login.min.css');
\backend\assets\AppAsset::addScript($this, 'static/pages/scripts/login2.min.js');
$this->title = '用户登录';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> 
<html lang="en" class="ie8 no-js"> 
<![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> 
<![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>" /> 
        <meta content="" name="author" />
        <meta content="" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?> 
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <body class=" login">
        <?php $this->beginBody() ?> 
        <div class="menu-toggler sidebar-toggler"></div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="static/images/logo.png" alt="debugphp" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="" method="post">
                <h3 class="form-title font-green">用户登录</h3>
                <div class="alert alert-danger display-hide return-msg">
                    <button class="close" data-close="alert"></button>
                    <span> 用户名和登录密码不能为空 </span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">用户名</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="用户名" name="username" /> 
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">密码</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="登录密码" name="password" /> 
                </div>
                <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['login/check']); ?>">
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">确 定</button>
                    <!-- <label class="rememberme check">
                        <input type="checkbox" name="remember" value="1" />Remember 
                    </label> -->
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> 2017 © Kunlun </div>
        <!--[if lt IE 9]>
        <script src="static/global/plugins/respond.min.js"></script>
        <script src="static/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>