<?php
/**
 * 反馈意见
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-27 09:18:43
 * @version $Id$
 */
    $this->title = '反馈意见';
    use yii\helpers\Url;
?>
<style>
    .status-line{height: 30px;line-height: 30px;font-size: 14px;color: #ccc;overflow: hidden;}
    .status{float: right;}
    .btn-wrap{position: fixed; bottom: 0;width: 100%;padding: 10px 5%;background-color: #fff;box-sizing: border-box;}
    .weui-cells{margin-bottom: 85px;border-bottom: none;}
</style>
<div class="weui-cells">
    <?php foreach ($list as $k => $v) {?>
    <div class="weui-cell">      
        <div class="weui-cell__bd">
            <div class="status-line">
                <span><?=$v['created_at']?></span>
                <span class="status"><?php if($v['status'] == 0){echo '处理中';}elseif($v['status'] == 1){echo '已回复';} ?></span>
            </div>
            <p><?=$v['content']?></p>
        </div>
    </div>
    <?php } ?>
</div>
<div class="btn-wrap">
    <a href="<?=Url::to(['/feedback/add'])?>" class="weui-btn weui-btn_primary">我要反馈</a>
</div>