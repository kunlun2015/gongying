<?php
/**
 * 分类页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 22:01:44
 * @version 1.0
 */
    $this->title = '分类';
    use yii\helpers\Url;
?>
<style>body{background: #fff;}</style>
<div class="classify">
    <ul class="classify-main">
        <?php foreach ($list as $k => $v) {?>
        <li<?php if($k === 0){ ?> class="active"<?php } ?> data-id="<?=$v['id']?>"><?=$v['name']?></li>
        <?php } ?>
    </ul>
    <?php foreach ($list as $k => $v) {?>
    <div class="classify-display <?php if($k != 0){ ?>none<?php } ?>" id="classify-<?=$v['id']?>">
        <?php foreach ($v['sub'] as $k2 => $v2) {?>
        <dl>
            <dt><?=$v2['name']?></dt>
            <?php foreach ($v2['sub'] as $k3 => $v3) {?>
            <dd><?=$v3['name']?></dd>
            <?php } ?>     
        </dl>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<?=$this->render('/layouts/footerMenu');?>