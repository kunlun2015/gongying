<?php
/**
 * 反馈意见-反馈详情
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-29 17:17:21
 * @version $Id$
 */

    $this->title = '反馈意见-反馈详情';
    use yii\helpers\Url;
?>
<style>
    .box{width: 90%;margin: 10px auto;padding: 10px 10px;background-color: #fff;}
    .weui-cells__title span{display: inline-block;float: right;}
    .waiting{margin-top: 20px;}
    .waiting i{display: block;margin: auto;width: 50px;font-size: 50px;}
    .waiting p{font-size: 14px;text-align: center;margin-top: 5px;}
</style>
<div class="weui-cells__title">反馈内容 <span><?=$detail['created_at']?></span></div>
<div class="box feedback"><?=$detail['content']?></div>
<?php if($detail['status'] == 1){ ?>
<div class="weui-cells__title" style="margin-top: 30px;">回复内容 <span><?=$detail['replied_at']?></span></div>
<div class="box reply"><?=$detail['reply']?></div>
<?php }else{ ?>
<div class="waiting">
    <i class="weui-icon-waiting weui-icon_msg"></i>
    <p>等待反馈结果</p>
</div>
<?php } ?>