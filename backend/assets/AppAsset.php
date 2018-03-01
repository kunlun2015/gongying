<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'static/global/plugins/font-awesome/css/font-awesome.min.css',
        'static/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'static/global/plugins/bootstrap/css/bootstrap.min.css',
        'static/global/plugins/uniform/css/uniform.default.css',
        'static/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',

        'static/global/css/components.min.css',
        'static/global/css/plugins.min.css',

        'static/layouts/layout/css/layout.min.css',
        'static/layouts/layout/css/themes/darkblue.min.css',
        'static/layouts/layout/css/custom.min.css',
        'static/css/style.css'
    ];
    public $js = [
        'static/global/plugins/jquery.min.js',
        'static/global/plugins/bootstrap/js/bootstrap.min.js',
        'static/global/plugins/js.cookie.min.js',
        'static/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'static/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'static/global/plugins/jquery.blockui.min.js',
        'static/global/plugins/uniform/jquery.uniform.min.js',
        'static/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'static/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'static/global/plugins/jquery-validation/js/additional-methods.min.js',
        'static/global/scripts/app.min.js',
        'static/layouts/layout/scripts/layout.min.js',
        'static/layouts/layout/scripts/demo.min.js',
        'static/layouts/global/scripts/quick-sidebar.min.js',
        'static/plugin/layer/layer.js',
        'static/js/common.js'
    ];
    public $depends = [
        
    ];

    //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {  
        $view->registerJsFile('@web/'.$jsfile, [/*AppAsset::className(), */'depends' => 'backend\assets\AppAsset']);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile('@web/'.$cssfile, [/*AppAsset::className(), */'depends' => 'backend\assets\AppAsset']);  
    }
}
