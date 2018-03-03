/**
 * 首页js
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-21 17:32:47
 * @version $Id$
 */

$(document).ready(function(){
    //轮播图
    var indexSwiper = new Swiper ('.slide-wrap', {
        direction: 'horizontal',
        autoplay: 5000,
        loop: false,        
        pagination: '.swiper-pagination',
        paginationClickable :true,
        autoplayDisableOnInteraction : false,
        observer:true,
    })
})