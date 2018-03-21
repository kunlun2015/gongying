<?php
/**
 * 求购页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 21:50:30
 * @version 1.0
 */
    $this->title = '求购页面';
    use yii\helpers\Url;
?>
<header>
    <div class="logo">
        <img src="<?=Yii::$app->params['staticUrl']?>images/logo.png" alt="">
    </div>
    <div class="search">
        <div class="weui-search-bar" id="searchBar">
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
<ul class="list">
    <?php foreach ($list as $k => $v) {?>
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
<div class="weui-loadmore weui-loadmore_line" data-page="1" data-total="<?=$totalPage?>">
  <span class="weui-loadmore__tips"><?php if($totalPage < 1){ ?>暂无数据<?php }elseif($totalPage == 1){?>已加载全部<?php }else{ ?>上滑加载更多<?php } ?></span>
</div>
<?php $this->beginBlock("pageJs") ?>
    $(document).ready(function(){
        var loading = false;
        $(document.body).infinite().on("infinite", function() {
            var totalPage = $('.weui-loadmore').data('total');
            var page = $('.weui-loadmore').data('page');
            if(loading || page >= totalPage) return;
            if(page < totalPage){
                $('.weui-loadmore .weui-loadmore__tips').text('正在加载，请稍后...');
            }
            loading = true;
            tools.ajax({
                url: '/purchase/get-data',
                dataType: 'json',
                type: 'post',
                data: {keywords: $('#searchInput').val(), page: page + 1},
                success: function(res){
                    if(res.code === 0){
                        console.log(res.data)
                        var html = '';
                        $.each(res.data, function(index, value){
                            html = '';
                            html += '<li><div class="list-t"><div class="thumb"><img src="<?=Yii::$app->params['imgUrl']?>'+value.pictures[0]+'.thumb.jpg" alt="'+value.title+'"></div><div class="list-info"><span class="price">议价</span><p class="title">'+value.title+'</p><p class="num">数量：'+value.num+'</p><p class="area">交付地区：'+value.delivery_area+'</p></div></div><div class="attr"><div class="cate"><span>'+value.fname+'</span><span>'+value.sname+'</span><span>'+value.tname+'</span></div><div class="keywords"><a href="">#'+value.fname+'#</a></div></div></li>';
                            $('.list').append(html);
                        })
                        $('.weui-loadmore').data('page', page + 1);
                        if(page + 1 >= totalPage){
                            $('.weui-loadmore .weui-loadmore__tips').text('已加载全部');
                        }else{
                            $('.weui-loadmore .weui-loadmore__tips').text('上滑加载更多');
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