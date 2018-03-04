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
    \frontend\assets\AppAsset::addScript($this, 'js/publish.js');
?>
<div class="publish-form">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">采购物资</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入物资名称">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">数量</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入数量">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">预算金额</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" pattern="[0-9]*" placeholder="您的预算金额">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">交付周期</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="物资交付周期">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">截至日期</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" id="datetime-picker" type="text" placeholder="截至日期">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">交付地区</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" id='city-picker' placeholder="选择交付地区"/>
            </div>
        </div>    
    </div>
    <div class="weui-cells__title">描述说明</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" placeholder="请输入说明信息" rows="3"></textarea>
                <div class="weui-textarea-counter"><span>0</span>/200</div>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">图片上传</p>
                        <div class="weui-uploader__info">0/2</div>
                    </div>
                    <div class="weui-uploader__bd">
                        <ul class="weui-uploader__files" id="uploaderFiles">
                            <li class="weui-uploader__file" style="background-image:url(./static/images/pic_160.png)"></li>
                            <li class="weui-uploader__file" style="background-image:url(./static/images/pic_160.png)"></li>
                            <li class="weui-uploader__file" style="background-image:url(./static/images/pic_160.png)"></li>
                            <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./static/images/pic_160.png)">
                                <div class="weui-uploader__file-content">
                                    <i class="weui-icon-warn"></i>
                                </div>
                            </li>
                            <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./static/images/pic_160.png)">
                                <div class="weui-uploader__file-content">50%</div>
                            </li>
                        </ul>
                        <div class="weui-uploader__input-box">
                            <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple="">
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
                <input class="weui-switch" type="checkbox">
            </div>
        </div>
    </div>
    <a href="javascript:;" class="weui-btn weui-btn_primary save-btn">保存</a>
</div>