<?php
/**
 * 发布页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-09 17:11:13
 * @version $Id$
 */
    $this->title = '发布页面';
    use yii\helpers\Url;
?>
<style>body{background-color: #fff;}</style>
<div class="publish-form">
    <form action="">
        <div class="input-item">
            <div class="item">采购物资：</div>
            <input type="text" placeholder="请输入物资名称">
        </div>
        <div class="input-item">
            <div class="item">数量：</div>
            <input type="number" placeholder="请输入数量">
        </div>
        <div class="input-item">
            <div class="item">预算金额：</div>
            <input type="text" placeholder="您的预算金额">
        </div>
        <div class="input-item">
            <div class="item">交付周期：</div>
            <input type="text" placeholder="物资交付周期">
        </div>
        <div class="input-item">
            <div class="item">截止日期：</div>
            <input type="text" placeholder="截止日期">
        </div>
        <div class="input-item">
            <div class="item">交付地区：</div>
        </div>
        <div class="input-item">
            <div class="item">描述说明：</div>
            <textarea name="description" id="description" placeholder="请对物资进行说明"></textarea>
        </div>
        <div class="input-item">
            <div class="item" style="float: left;">上传图片：</div>
            <div class="pictures">
                <img src="http://local.gongying.com/static/images/banner-2.jpg" alt="">
            </div>
            <i class="btn-upload fa fa-plus"></i>
        </div>
        <div class="input-item">
            <div class="item">匿名发布：</div>
        </div>
        <input type="button" value="保存" class="btn-submit">
    </form>
</div>