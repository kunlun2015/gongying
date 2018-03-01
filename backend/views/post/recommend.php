<?php
/**
 * 推荐文章
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-13 12:35:47
 * @version $Id$
 */
$this->title = '文章管理-推荐文章';
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">            
            <div class="portlet-body form">
                <form class="form-horizontal recommend-post-form" role="form" method="post" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">推荐到</label>
                            <div class="col-md-9">
                                 <div class="icheck-inline">
                                    <label>
                                        <input type="radio" name="recommend_type" <?php if($recommendType[0] == 1) echo 'checked'; ?> class="icheck" value="1"> 首页左侧
                                    </label>
                                    <label>
                                        <input type="radio" name="recommend_type" <?php if($recommendType[0] == 2) echo 'checked'; ?> class="icheck" value="2"> 首页左侧上
                                    </label>
                                    <label>
                                        <input type="radio" name="recommend_type" <?php if($recommendType[0] == 3) echo 'checked'; ?> class="icheck" value="3"> 首页上右侧上
                                    </label>
                                    <label style="margin-left: 0;">
                                        <input type="radio" name="recommend_type" <?php if($recommendType[0] == 4) echo 'checked'; ?> class="icheck" value="4"> 首页上右侧下
                                    </label>
                                    <label>
                                        <input type="radio" name="recommend_type" <?php if($recommendType[0] == 0) echo 'checked'; ?> class="icheck" value="0"> 取消推荐
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>                      
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green submit-recommend">确 定</button>
                                <button type="button" class="btn default close-layer">取 消</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pid" value="<?=$pid?>">
                    <input type="hidden" name="act" value="recommend">
                    <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['post/action']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<script>var page = 'recommendPost'</script>
<?php  \backend\assets\AppAsset::addCss($this, 'static/global/plugins/icheck/skins/all.css'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/global/plugins/icheck/icheck.min.js'); ?>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/post.js'); ?>
  