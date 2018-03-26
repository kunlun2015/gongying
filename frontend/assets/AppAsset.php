<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle{
    public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $baseUrl = 'http://gongying.debugphp.com/static/';
    public $css = [
        'css/common.css',
        'css/style.css?v=20180320',
        'libs/font-awesome/css/font-awesome.min.css',
        'https://res.wx.qq.com/open/libs/weui/1.1.2/weui.min.css',
        'libs/weui/css/jquery-weui.min.css'
    ];
    public $js = [
        'libs/jquery/jquery-3.1.0.min.js',        
        'libs/weui/js/jquery-weui.min.js',
        'js/common.js'
    ];

    //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {
        if(strpos($jsfile, 'http://') === false && strpos($jsfile, 'https://') === false && strpos($jsfile, '//') === false){
            $jsfile = 'http://gongying.debugphp.com/static/'.$jsfile;
        }
        $view->registerJsFile($jsfile, [/*AppAsset::className(), */'depends' => 'frontend\assets\AppAsset']); 
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        if(strpos($cssfile, 'http://') === false && strpos($cssfile, 'https://') === false && strpos($cssfile, '//') === false){
            $cssfile = 'http://gongying.debugphp.com/static/'.$cssfile;
        }
        $view->registerCssFile($cssfile, [/*AppAsset::className(), */'depends' => 'frontend\assets\AppAsset']);  
    }  
}
