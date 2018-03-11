<?php
/**
 * 
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-09 18:12:27
 * @version $Id$
 */
    $this->title = '详情页';
    use yii\helpers\Url;
?>
<style>    
    .weui-form-preview__value{text-align: left;font-size: 18px !important;}
    .weui-form-preview__hd{padding: 5px 15px !important;}
</style>
<div class="weui-cells__title">订单详情</div>
<div class="weui-form-preview">
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label"><?= $detail['type'] == 1 ? '采购': '供应' ?>物资</label>
        <em class="weui-form-preview__value"><?=$detail['title']?></em>
    </div>
    <?php if($detail['type'] == 1){ ?>
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">数量</label>
        <em class="weui-form-preview__value"><?=$detail['num']?></em>
    </div>
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">预算金额</label>
        <em class="weui-form-preview__value"><?=$detail['budget']?></em>
    </div>
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">交付周期</label>
        <em class="weui-form-preview__value"><?=$detail['delivery_cycle']?></em>
    </div>
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">截至日期</label>
        <em class="weui-form-preview__value"><?=$detail['deadline']?></em>
    </div>
    <?php } ?>
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label"><?= $detail['type'] == 1 ? '交付': '所在' ?>地区</label>
        <em class="weui-form-preview__value"><?=$detail['delivery_area']?></em>
    </div>
</div>
<div class="weui-cells__title">描述说明</div>
<div class="weui-form-preview">
    <div class="weui-form-preview__hd">
        <em class="weui-form-preview__value"><?=$detail['description']?></em>
        <div class="pictures-list">
            <?php foreach ($detail['pictures'] as $k => $v) {?>
            <img src="<?=Yii::$app->params['imgUrl'].$v?>" alt="<?=$detail['title']?>">
            <?php } ?>
        </div>
    </div>
</div>