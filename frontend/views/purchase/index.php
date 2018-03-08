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
<ul class="list">
    <?php foreach ($list as $k => $v) {?>
    <li>
        <div class="list-t">
            <div class="thumb">
                <img src="<?=Yii::$app->params['imgUrl'].$v['pictures'][0]?>.thumb.jpg" alt="<?=$v['title']?>">
            </div>            
            <div class="list-info">
                <span class="price">议价</span>
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
<div class="weui-loadmore weui-loadmore_line">
  <span class="weui-loadmore__tips">暂无数据</span>
</div>
<?=$this->render('/layouts/footerMenu');?>