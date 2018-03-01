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
        <input type="search" placeholder="搜索采购、供应">
    </div>
</header>
<div class="slide-wrap">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <a href="">
                <img src="http://local.gongying.com/static/images/banner-1.jpg" alt="城市合伙人">
            </a>
        </div>
        <div class="swiper-slide">
            <a href="">
                <img src="http://local.gongying.com/static/images/banner-2.jpg" alt="老年点读笔">
            </a>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>

<div class="cate-change-select">
    <span class="active">最新订单</span>
    <span>最新供应</span>
    <a href="">查看更多</a>
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
<footer>
    <div class="menu active"><a href="<?=Url::to(['/'])?>"><i class="fa fa-home"></i>首页</a></div>
    <div class="menu"><a href=""><i class="fa fa-bars"></i>分类</a></div>
    <div class="menu"><a href=""><i class="fa fa-window-restore"></i>求购</a></div>
    <div class="menu"><a href=""><i class="fa fa-commenting-o"></i>消息</a></div>
    <div class="menu"><a href="<?=Url::to(['/my'])?>"><i class="fa fa-user"></i>我的</a></div>
</footer>