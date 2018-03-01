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
            <p>找供应商太麻烦</p>
            <p>把您的采购需求告诉我们</p>
            <p>一键发布采购讯息让优质供应商主动联系您</p>
        </div>        
        <a href="<?=Url::to(['/publish', 'type'=>'purchase'])?>">发布求购</a>
    </li>
    <li></li>
</ul>