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
        <img src="http://local.gongying.com/static/images/logo.png" alt="">
    </div>
    <div class="search">
        <div class="weui-search-bar" id="searchBar">
            <form class="weui-search-bar__form">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
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
<ul class="list purchase">
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器1</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
</ul>
<ul class="list supply none">
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器2</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
                <p class="title">请购此款散热器</p>
                <p class="num">数量：100000</p>
                <p class="area">交付地区：广东省深圳市宝安区</p>
            </div>
        </div>
        <div class="attr">
            <div class="cate">
                <span>一级分类</span>
                <span>二级分类</span>
                <span>三级分类</span>
            </div>
            <div class="keywords">#散热器#</div>
        </div>            
    </li>
</ul>
<div class="btn-publish">
    <a href="<?=Url::to(['/publish'])?>"><i class="fa fa-pencil-square-o"></i>发布</a>
</div>
<?=$this->render('/layouts/footerMenu');?>