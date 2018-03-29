<?php
/**
 * 
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-28 16:52:51
 * @version $Id$
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Wx;

class TestController extends Controller {

    public function actionIndex()
    {
        $wx = new Wx;
        $data = [
            'touser' => 'oX4sxs_gwE83idD1mXI3QXl32LYc',
            'template_id' => 'KGNI9no-_UVxYgWJ6VQHkfca8Toi2-_SzTbfEHCQP04',
            'url' => 'http://www.baidu.com',
            'data' => [
                'username' => [
                    'value' => 'Amos',
                    'color' => '#173177'
                ]
            ]
        ];
        $rst = $wx->sendTemplateMsg($data);
        var_dump($rst);
    }

}