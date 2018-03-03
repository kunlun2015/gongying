<?php
/**
 * 选择发布类型
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-09 17:14:16
 * @version $Id$
 */
    $this->title = '选择发布类型';
    use yii\helpers\Url;
?>
<style>body{background-color: #fff;}</style>
<ul class="type-select">
    <li>
        <div class="text">
            <p>找供应商太麻烦?</p>
            <p>把您的采购需求告诉我们</p>
            <p>一键发布采购讯息让优质供应商主动联系您</p>
        </div>        
        <a href="<?=Url::to(['/publish', 'type'=>'purchase'])?>">发布求购</a>
    </li>
    <li class="btn-publish-supply">
         <div class="text">
            <p>想要找客户？</p>
            <p>把您经营的产品告诉我们</p>
            <p>我们将为您提供产品信息展示、搜索引擎</p>
            <p>推荐采购客户等服务</p>
        </div>        
        <a href="<?=Url::to(['/publish', 'type'=>'supply'])?>">发布产品</a>
    </li>
</ul>