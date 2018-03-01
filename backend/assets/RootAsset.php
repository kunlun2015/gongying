<?php
/**
 * 系统管理资源
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 14:11:02
 * @version $Id$
 */
namespace backend\assets;
use yii\web\AssetBundle;

class RootAsset extends AssetBundle
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
        'static/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css',
        'static/global/plugins/bootstrap-modal/css/bootstrap-modal.css',

        'static/global/plugins/icheck/skins/all.css',
        'static/global/css/components.min.css',        
        'static/global/plugins/select2/css/select2.min.css',
        'static/global/plugins/select2/css/select2-bootstrap.min.css',
        'static/global/plugins/datatables/datatables.min.css',
        'static/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
        'static/global/css/plugins.min.css',

        'static/layouts/layout2/css/layout.min.css',
        'static/layouts/layout2/css/themes/blue.min.css',
        'static/layouts/layout2/css/custom.min.css',
        'static/pages/css/login-2.min.css',
        'static/css/style_root.css'

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
        'static/global/plugins/select2/js/select2.full.min.js',
        'static/global/plugins/jquery-validation/js/jquery.validate.min.js',
        'static/global/plugins/jquery-validation/js/additional-methods.min.js',
        'static/global/scripts/datatable.js',
        'static/global/plugins/datatables/jquery.dataTables.min.js',
        'static/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
        'static/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
        'static/global/plugins/bootstrap-modal/js/bootstrap-modal.js',
        'static/global/scripts/app.min.js',
        'static/layouts/layout2/scripts/layout.min.js',
        'static/layouts/layout2/scripts/demo.min.js',
        'static/layouts/global/scripts/quick-sidebar.min.js',
        'static/global/plugins/select2/js/select2.full.min.js',
        'static/global/plugins/icheck/icheck.min.js',
        'static/plugin/layer/layer.js',
        'static/js/root/common.js'
    ];
    public $depends = [
        
    ];

    //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {  
        $view->registerJsFile('@web/'.$jsfile, [/*AppAsset::className(), */'depends' => 'backend\assets\RootAsset']);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile('@web/'.$cssfile, [/*AppAsset::className(), */'depends' => 'backend\assets\RootAsset']);  
    }  
}
