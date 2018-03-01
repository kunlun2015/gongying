<?php
/**
 * 用户菜单
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-20 10:05:22
 * @version $Id$
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php foreach ($userMenuLevel as $kMenu => $vMenu) { ?>
<li class="heading">
    <h3 class="uppercase"><?=$vMenu['name']?></h3>
</li>
<?php foreach ($vMenu['children'] as $kFirstMenu => $vFirstMenu) { ?>
<li class="nav-item <?php if(Yii::$app->controller->id === $vFirstMenu['controller']){ echo 'active'; if(count($vFirstMenu['children']) > 0){echo ' open';}} ?>">
    <a href="<?php if(isset($vFirstMenu['children']) && count($vFirstMenu['children']) > 0){ ?>javascript:;<?php }else{ if($vFirstMenu['url']){echo $vFirstMenu['url'];}else{echo Url::to(["{$vFirstMenu['controller']}/{$vFirstMenu['method']}"]);}  ?><?php } ?>" class="nav-link nav-toggle">
        <i class="<?=$vFirstMenu['icon']?>"></i>
        <span class="title"><?=$vFirstMenu['name']?></span>
        <?php if (isset($vFirstMenu['children']) && count($vFirstMenu['children']) > 0){ ?>
        <span class="arrow<?php if(Yii::$app->controller->id === $vFirstMenu['controller']) echo ' open'; ?>"></span>
        <?php } ?>
    </a>
    <?php if (isset($vFirstMenu['children']) && count($vFirstMenu['children']) > 0){ ?>    
    <ul class="sub-menu" style="<?php if(Yii::$app->controller->id === $vFirstMenu['controller']){echo 'display: block';}else{echo 'display: none;';} ?>">
        <?php foreach ($vFirstMenu['children'] as $kSecondMenu => $vSecondMenu) { ?>
        <li class="nav-item <?php if(Yii::$app->controller->id === $vSecondMenu['controller'] && (Yii::$app->controller->action->id === $vSecondMenu['method']) || explode('-', Yii::$app->controller->action->id)[0] == $vSecondMenu['method']){echo 'active open';}?>">
            <a href="<?php if(isset($vSecondMenu['children']) && count($vSecondMenu['children']) > 0){ ?>javascript:;<?php }else{ if($vSecondMenu['url']){echo $vSecondMenu['url'];}else{echo Url::to(["/{$vSecondMenu['controller']}/{$vSecondMenu['method']}"]);}  ?><?php } ?>" class="nav-link nav-toggle">
                <span class="title"><?=$vSecondMenu['name']?></span>
                <?php if (isset($vSecondMenu['children']) && count($vSecondMenu['children']) > 0){ ?>
                <span class="arrow<?php if(Yii::$app->controller->id === $vSecondMenu['controller'] && in_array(Yii::$app->controller->action->id, array_column($vSecondMenu['children'], 'method'))) echo ' open'; ?>"></span>
                <?php } ?>
            </a>
            <?php if (isset($vSecondMenu['children']) && count($vSecondMenu['children']) > 0){ ?>   
            <ul class="sub-menu" style="<?php if(Yii::$app->controller->id === $vSecondMenu['controller'] && in_array(Yii::$app->controller->action->id, array_column($vSecondMenu['children'], 'method'))){echo 'display: block';}else{echo 'display: none;';} ?>">
                <?php foreach ($vSecondMenu['children'] as $kThirdMenu => $vThirdMenu) { ?>
                <li class="nav-item <?php if(Yii::$app->controller->id === $vThirdMenu['controller'] && Yii::$app->controller->action->id === $vThirdMenu['method']){echo 'active';} ?>">
                    <a href="<?php if($vThirdMenu['url']){echo $vThirdMenu['url'];}else{echo Url::to(["/{$vThirdMenu['controller']}/{$vThirdMenu['method']}"]);} ?>" class="nav-link "> <?=$vThirdMenu['name']?> </a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>
</li>
<?php } ?>
<?php } ?>