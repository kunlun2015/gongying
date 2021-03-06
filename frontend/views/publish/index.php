<?php
/**
 * 发布页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-09 17:11:13
 * @version $Id$
 */
    $this->title = '发布页面';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addScript($this, 'libs/weui/js/city-picker.min.js');    
    \frontend\assets\AppAsset::addScript($this, 'libs/stream/js/stream-v1.js');
    \frontend\assets\AppAsset::addScript($this, 'js/publish.js?v=31sdfdf');
?>
<div class="publish-form">
    <form action="">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label"><?= $type === 1 ? '采购': '供应' ?>物资</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="title" type="text" placeholder="请输入物资名称">
            </div>
        </div>
        <?php if($type === 1){ ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">数量</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="num" type="number" pattern="[0-9]*" placeholder="请输入数量(数字)">
            </div>
        </div>
        <?php } ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">所属分类</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="classify" type="text" readonly="readonly" placeholder="请选择所属分类">
                <input class="weui-input none" name="classify-1" type="text" placeholder="请选择所属分类">
                <input class="weui-input none" name="classify-2" type="text" placeholder="请选择所属分类">
                <input class="weui-input none" name="classify-3" type="text" placeholder="请选择所属分类">
                <input type="hidden" name="fid">
                <input type="hidden" name="sid">
                <input type="hidden" name="tid">
            </div>
        </div>
        <?php if($type === 1){ ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">预算金额</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="budget" type="number" pattern="[0-9]*" placeholder="您的预算金额(数字)">
            </div>
        </div>        
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">交付周期</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="delivery_cycle" type="number" placeholder="物资交付周期(数字,单位：天)">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">截至日期</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="deadline" id="datetime-picker" type="text" placeholder="截至日期">
            </div>
        </div>
        <?php } ?>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label"><?= $type === 1 ? '交付': '所在' ?>地区</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="delivery_area" type="text" id='city-picker' placeholder="选择交付地区"/>
            </div>
        </div>    
    </div>
    <div class="weui-cells__title">描述说明</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea description" name="description" placeholder="请输入说明信息" rows="3"></textarea>
                <div class="weui-textarea-counter description-counter"><span>0</span>/255</div>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">图片上传</p>
                        <div class="weui-uploader__info">0/8</div>
                    </div>
                    <div class="weui-uploader__bd">
                        <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                        <div class="weui-uploader__input-box">
                            <div id="uploaderInput" class="weui-uploader__input"><span></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">匿名发布</div>
            <div class="weui-cell__ft">
                <input class="weui-switch" name="anonymous" type="checkbox" value="1">
            </div>
        </div>
    </div>
    <input type="hidden" name="type" value="<?=$type?>">
    <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
    <a href="javascript:;" class="weui-btn weui-btn_primary save-btn">保存</a>
    </form>
</div>
<div class="weui-gallery" id="gallery">
    <span class="weui-gallery__img" id="galleryImg"></span>
    <div class="weui-gallery__opr">
        <a href="javascript:" class="weui-gallery__del">
            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
        </a>
    </div>
</div>
<script>
    var classify = <?=json_encode($classify)?>;
    var type = <?=$type?>;
</script>
