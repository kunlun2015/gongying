<?php
/**
 * 添加/编辑微信回复关键字
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-05 15:56:03
 * @version $Id$
 */

$this->title = '微信管理-回复关键字';
use yii\helpers\Url;
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo Url::to(['/site']); ?>">首页</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo Url::to(['/otags']); ?>">微信管理</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>回复关键字</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">添加</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal replyKeywords-form" role="form" novalidate="novalidate">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">公众号</label>
                            <div class="col-md-9">
                                <select name="appid" id="appid" class="form-control input-inline input-medium">
                                    <?php foreach ($account as $k => $v) {?>
                                    <option value="<?=$v['appid']?>"><?=$v['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">关键字</label>
                            <div class="col-md-9">
                                <input type="text" name="keywords" class="form-control input-inline input-medium" placeholder="标签名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">回复类型</label>
                            <div class="col-md-9">
                                <select name="type" id="type" class="form-control input-inline input-medium reply-type">
                                    <option value="">请选择回复类型</option>
                                    <option value="text">文本消息</option>
                                    <option value="image">图片消息</option>
                                    <option value="news">图文消息</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group reply-type-list reply-text none">
                            <label class="col-md-3 control-label">回复内容</label>
                            <div class="col-md-9">
                                <textarea name="content" id="content" cols="5" class="form-control" placeholder="备注"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">确 定</button>
                                <button type="button" class="btn default">取 消</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="act" value="saveReplyKeywords">
                    <input type="hidden" id="csrf" name="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->getCsrfToken();?>">
                    <input disabled="disabled" type="hidden" name="request_url" value="<?php echo Url::to(['wechat/action']); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<?php  \backend\assets\AppAsset::addScript($this, 'static/js/wechat.js'); ?>