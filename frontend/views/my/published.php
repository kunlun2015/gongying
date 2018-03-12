<?php
/**
 * 我的发布
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-10 16:54:16
 * @version 1.0
 */
    $this->title = '我的发布';
    use yii\helpers\Url;
?>
<div class="cate-change-select">
    <span class="active" data-type="1">我的订单</span>
    <span data-type="2">我的供应</span>
</div>
<ul class="list purchase">
    <?php foreach ($purchaseList as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>.thumb.jpg" alt="<?=$v['title']?>">
            </div>            
            <div class="list-info">
                <span class="price action-btn">
                    <a href="<?=Url::to(['/publish/edit', 'id' => $v['id']])?>">编辑</a>
                    <a href="javascript:;" class="delete" data-id="<?=$v['id']?>">删除</a>
                </span>
                <p class="title"><?=$v['title']?></p>
                <p class="num">数量：<?=$v['num']?></p>
                <p class="area">交付地区：<?=$v['delivery_area']?></p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span><?=$v['fname']?></span>
                <span><?=$v['sname']?></span>
                <span><?=$v['tname']?></span>
            </div>
            <div class="keywords"><a href="">#<?=$v['fname']?>#</a></div>
        </div>            
    </li>
    <?php } ?>
</ul>
<ul class="list supply none">
    <?php foreach ($supplyList as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>" alt="">
            </div>            
            <div class="list-info">
                <span class="price action-btn">
                    <a href="<?=Url::to(['/publish/edit', 'id' => $v['id']])?>">编辑</a>
                    <a href="javascript:;" class="delete" data-id="<?=$v['id']?>">删除</a>
                </span>
                <p class="title"><?=$v['title']?></p>
                <p class="num">服务商：<?=$v['num']?></p>
                <p class="area">所在地区：<?=$v['delivery_area']?></p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span><?=$v['fname']?></span>
                <span><?=$v['sname']?></span>
                <span><?=$v['tname']?></span>
            </div>
            <div class="keywords"><a href="">#<?=$v['fname']?>#</a></div>
        </div>            
    </li>
    <?php } ?>
</ul>
<div class="weui-loadmore weui-loadmore_line" data-page="1" data-total="<?=$purchaseTotalPage?>">    
  <span class="weui-loadmore__tips"><?php if($purchaseTotalPage < 1){ ?>暂无数据<?php }else{ ?>上滑加载更多<?php } ?></span>
</div>
<div class="weui-loadmore weui-loadmore_line none" data-page="1" data-total="<?=$supplyTotalPage?>">
  <span class="weui-loadmore__tips"><?php if($supplyTotalPage < 1){ ?>暂无数据<?php }else{ ?>上滑加载更多<?php } ?></span>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        var loading = false;
        $(document.body).infinite().on("infinite", function() {
            var type = $('.cate-change-select .active').data('type');
            var totalPage = $('.weui-loadmore').eq(type-1).data('total');
            var page = $('.weui-loadmore').eq(type-1).data('page');
            if(loading || page >= totalPage) return;
            if(page < totalPage){
                $('.weui-loadmore').eq(type-1).children('.weui-loadmore__tips').text('正在加载，请稍后...');
            }
            loading = true;
            tools.ajax({
                url: '',
                dataType: 'json',
                type: 'post',
                data: {type: type, keywords: $('#searchInput').val(), page: page + 1},
                success: function(res){
                    if(res.code === 0){
                        var html = '';
                        if(type === 1){
                            $.each(res.data, function(index, value){
                                html = '';
                                html += '<li><div class="list-t"><div class="thumb"><img src="<?=Yii::$app->params['imgUrl']?>'+value.pictures[0]+'.thumb.jpg" alt="'+value.title+'"></div><div class="list-info"><span class="price">议价</span><p class="title">'+value.title+'</p><p class="num">数量：'+value.num+'</p><p class="area">交付地区：'+value.delivery_area+'</p></div></div><div class="attr"><div class="cate"><span>'+value.fname+'</span><span>'+value.sname+'</span><span>'+value.tname+'</span></div><div class="keywords"><a href="">#'+value.fname+'#</a></div></div></li>';
                                $('.list').eq(type-1).append(html);
                            })
                        }else if(type === 2){
                            $.each(res.data, function(index, value){
                                html = '';
                                html += '<li><div class="list-t"><div class="thumb"><img src="<?=Yii::$app->params['imgUrl']?>'+value.pictures[0]+'.thumb.jpg" alt="'+value.title+'"></div><div class="list-info"><span class="price">议价</span><p class="title">'+value.title+'</p><p class="num">服务商：'+value.num+'</p><p class="area">所在地区：'+value.delivery_area+'</p></div></div><div class="attr"><div class="cate"><span>'+value.fname+'</span><span>'+value.sname+'</span><span>'+value.tname+'</span></div><div class="keywords"><a href="">#'+value.fname+'#</a></div></div></li>';
                                $('.list').eq(type-1).append(html);
                            })
                        }                        
                        $('.weui-loadmore').eq(type-1).data('page', page + 1);
                        if(page + 1 >= totalPage){
                            $('.weui-loadmore').eq(type-1).children('.weui-loadmore__tips').text('已加载全部');
                        }else{
                            $('.weui-loadmore').eq(type-1).children('.weui-loadmore__tips').text('上滑加载更多');
                        }
                    }
                },
                complete: function(){
                    loading = false;
                }
            })
        });
        $(document).on('click', '.delete', function(){
            var _this = $(this);
            $.confirm("确定要删除吗？", function() {
                tools.ajax({
                    url: '/publish/delete',
                    dataType: 'json',
                    type: 'post',
                    data: {id: _this.data('id')},
                    success: function(res){
                        if(res.code === 0){
                            $.toast(res.msg, 1000, function(){
                                _this.parents('li').remove();
                            });
                        }else{
                            $.toast(res.msg, 'cancel');
                        }
                    }
                })
            }, function() {
                
            });
            return false;
        })
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>
<?=$this->render('/layouts/footerMenu');?>