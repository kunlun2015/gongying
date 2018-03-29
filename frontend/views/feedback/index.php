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
    .btn-wrap{position: fixed;z-index: 99; bottom: 0;width: 100%;padding: 10px 5%;background-color: #fff;box-sizing: border-box;}    
    .weui-loadmore{margin-bottom: 60px !important;}
</style>
<div class="weui-cells">
    <?php foreach ($list as $k => $v) {?>
    <a href="<?=Url::to(['/feedback/show', 'id' => $v['id']])?>" class="weui-cell">      
        <div class="weui-cell__bd">
            <div class="status-line">
                <span><?=$v['created_at']?></span>
                <span class="status"><?php if($v['status'] == 0){echo '处理中';}elseif($v['status'] == 1){echo '已回复';} ?></span>
            </div>
            <p><?=$v['content']?></p>
        </div>
    </a>
    <?php } ?>
</div>
<div class="weui-loadmore weui-loadmore_line" data-page="1" data-total="<?=$totalPage?>">
  <span class="weui-loadmore__tips"><?php if($totalPage < 1){ ?>暂无数据<?php }elseif($totalPage == 1){?>已加载全部<?php }else{ ?>上滑加载更多<?php } ?></span>
</div>
<div class="btn-wrap">
    <a href="<?=Url::to(['/feedback/add'])?>" class="weui-btn weui-btn_primary">我要反馈</a>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        var loading = false;
        $(document.body).infinite().on("infinite", function() {
            var totalPage = $('.weui-loadmore').data('total');
            var page = $('.weui-loadmore').data('page');
            if(loading || page >= totalPage) return;
            if(page < totalPage){
                $('.weui-loadmore').children('.weui-loadmore__tips').text('正在加载，请稍后...');
            }
            loading = true;
            tools.ajax({
                url: '/feedback/list',
                dataType: 'json',
                type: 'get',
                data: {page: page + 1},
                success: function(res){
                    if(res.code === 0){
                        var html = '';
                        $.each(res.data.list, function(index, value){
                            var status = '';
                            if(value.status == 0){
                                status = '处理中';
                            }else if(value.status == 1){
                                status = '已回复';
                            }
                            html += '<a href="<?=Url::to(['/feedback/show'])?>?id='+value.id+'" class="weui-cell"><div class="weui-cell__bd"><div class="status-line"><span>'+value.created_at+'</span><span class="status">'+status+'</span></div><p>'+value.content+'</p></div></a>';
                        })
                        $('.weui-cells').append(html);
                        $('.weui-loadmore').data('page', page + 1);
                        if(page + 1 >= totalPage){
                            $('.weui-loadmore').children('.weui-loadmore__tips').text('已加载全部');
                        }else{
                            $('.weui-loadmore').children('.weui-loadmore__tips').text('上滑加载更多');
                        }
                    }
                },
                complete: function(){
                    loading = false;
                }
            })
        });
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>