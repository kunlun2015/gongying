<?php
/**
 * 产品列表页
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-03 10:14:02
 * @version $Id$
 */
    $this->title = '列表页';
    use yii\helpers\Url;
?>
<header>
    <div class="logo">
        <img src="<?=Yii::$app->params['staticUrl']?>images/logo.png" alt="">
    </div>
    <div class="search">
        <div class="weui-search-bar<?php if($keywords){ ?> weui-search-bar_focusing<?php } ?>" id="searchBar">
            <form class="weui-search-bar__form">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" name="keywords" value="<?=$keywords?>" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
                    <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                </div>
                <label class="weui-search-bar__label" id="searchText">
                    <i class="weui-icon-search"></i>
                    <span>搜索</span>
                </label>
            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
        </div>
    </div>
</header>
<div class="cate-change-select">
    <span class="active" data-type="1">最新订单</span>
    <span data-type="2">最新供应</span>
</div>
<ul class="list purchase">
    <?php foreach ($purchaseList as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <a href="<?=Url::to(['/detail', 'id' => $v['id']])?>"><img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>.thumb.jpg" alt="<?=$v['title']?>"></a>
            </div>            
            <div class="list-info">
                <span class="price"><a href="<?=Url::to(['/detail', 'id' => $v['id']])?>">议价</a></span>
                <p class="title"><a href="<?=Url::to(['/detail', 'id' => $v['id']])?>"><?=$v['title']?></a></p>
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
            <div class="keywords"><a href="<?=Url::to(['/list', 'fid' => $v['fid']])?>">#<?=$v['fname']?>#</a></div>
        </div>            
    </li>
    <?php } ?>
</ul>
<ul class="list supply none">
    <?php foreach ($supplyList as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <a href="<?=Url::to(['/detail', 'id' => $v['id']])?>"><img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>.thumb.jpg" alt="<?=$v['title']?>"></a>
            </div>            
            <div class="list-info">
                <span class="price"><a href="<?=Url::to(['/detail', 'id' => $v['id']])?>">议价</a></span>
                <p class="title"><a href="<?=Url::to(['/detail', 'id' => $v['id']])?>"><?=$v['title']?></a></p>
                <p class="num">服务商：<?=$v['provider']?></p>
                <p class="area">所在地区：<?=$v['delivery_area']?></p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span><?=$v['fname']?></span>
                <span><?=$v['sname']?></span>
                <span><?=$v['tname']?></span>
            </div>
            <div class="keywords"><a href="<?=Url::to(['/list', 'fid' => $v['fid']])?>">#<?=$v['fname']?>#</a></div>
        </div>            
    </li>
    <?php } ?>
</ul>
<div class="weui-loadmore weui-loadmore_line" data-page="1" data-total="<?=$purchaseTotalPage?>">    
  <span class="weui-loadmore__tips"><?php if($purchaseTotalPage < 1){ ?>暂无数据<?php }elseif($purchaseTotalPage == 1){?>已加载全部<?php }else{ ?>上滑加载更多<?php } ?></span>
</div>
<div class="weui-loadmore weui-loadmore_line none" data-page="1" data-total="<?=$supplyTotalPage?>">
  <span class="weui-loadmore__tips"><?php if($supplyTotalPage < 1){ ?>暂无数据<?php }elseif($supplyTotalPage == 1){?>已加载全部<?php }else{ ?>上滑加载更多<?php } ?></span>
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
                url: '/list/get-data',
                dataType: 'json',
                type: 'post',
                data: {type: type, fid: <?=$fid?>, sid: <?=$sid?>, tid: <?=$tid?>, keywords: $('#searchInput').val(), page: page + 1},
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
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["pageJs"], \yii\web\View::POS_END); ?>
<?=$this->render('/layouts/footerMenu');?>