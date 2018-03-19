<?php
/**
 * 网站首页
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-02-06 14:24:48
 * @version $Id$
 */
    $this->title = '首页';
    use yii\helpers\Url;
    \frontend\assets\AppAsset::addCss($this, 'libs/swiper/css/swiper.min.css');
    \frontend\assets\AppAsset::addScript($this, 'libs/swiper/js/swiper.jquery.min.js');
    \frontend\assets\AppAsset::addScript($this, 'js/index.js');
?>
<header>
    <div class="logo">
        <img src="<?=Yii::$app->params['staticUrl']?>images/logo.png" alt="">
    </div>
    <div class="search">
        <div class="weui-search-bar" id="searchBar">
            <form class="weui-search-bar__form" action="<?=Url::to(['/list'])?>">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" name="keywords" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
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
<div class="slide-wrap">
    <div class="swiper-wrapper">
        <?php foreach ($bannerList as $k => $v) {?>
        <div class="swiper-slide">
            <a href="<?=$v['href']?>">
                <img src="<?=Yii::$app->params['imgUrl'].$v['picture']?>" alt="<?=$v['title']?>">
            </a>
        </div>
        <?php } ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
<div class="cate-change-select">
    <span class="active">最新订单</span>
    <span>最新供应</span>
    <a href="<?=Url::to(['/list'])?>">查看更多</a>
</div>
<ul class="list mb-55 purchase">
    <?php foreach ($purchaseList as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>.thumb.jpg" alt="<?=$v['title']?>">
            </div>            
            <div class="list-info">
                <span class="price"><a href="<?=Url::to(['/detail', 'id' => $v['id']])?>">议价</a></span>
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
            <div class="keywords"><a href="<?=Url::to(['/list', 'fid' => $v['fid']])?>">#<?=$v['fname']?>#</a></div>
        </div>            
    </li>
    <?php } ?>
</ul>
<ul class="list mb-55 supply none">
    <?php foreach ($supplyList as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>" alt="">
            </div>            
            <div class="list-info">
                <span class="price"><a href="<?=Url::to(['/detail', 'id' => $v['id']])?>">议价</a></span>
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
            <div class="keywords"><a href="<?=Url::to(['/list', 'fid' => $v['fid']])?>">#<?=$v['fname']?>#</a></div>
        </div>            
    </li>
    <?php } ?>
</ul>
<div class="btn-publish">
    <a href="<?=Url::to(['/publish'])?>"><i class="fa fa-pencil-square-o"></i>发布</a>
</div>
<?=$this->render('/layouts/footerMenu');?>