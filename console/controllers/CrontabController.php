<?php
/**
 * 定时执行
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-12-23 10:25:09
 * @version $Id$
 */

namespace console\controllers;
use Yii;
use yii\console\Controller;
use yii\helpers\Url;
use console\models\Posts;

class CrontabController extends ConsoleController{

    public function actionSitemap()
    {
        $posts = new Posts;
        $list = $posts->list();
        $xml = '<?xml version="1.0" encoding="utf-8"?><urlset>';
        foreach ($list as $k => $v) {
            $date = date('Y-m-d', strtotime($v['create_at']));
            $url = "http://www.debugphp.com/{$v['fmap']}/{$v['id']}.html";
            $xml .= "<url>
                   <loc>{$url}</loc>
                   <lastmod>{$date}</lastmod>
                   <changefreq>weekly</changefreq>
                   <priority>1</priority>
               </url>";
        }
        $xml .= '</urlset>';
        $siteMapFile = dirname($this->app->basePath).'/frontend/web/sitemap.xml';        
        file_put_contents($siteMapFile, $xml);
    }

}