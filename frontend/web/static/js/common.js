/**
 * common js
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-15 14:16:47
 * @version $Id$
 */
$(document).ready(function(){
    //订单、供应切换
    $('.cate-change-select span').click(function(){
        if($(this).hasClass('active')){
            return false;
        }
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('.list').hide();
        $('.list').eq($(this).index()).show();
        if($('.weui-loadmore').length === 2){
            $('.weui-loadmore').addClass('none');
            $('.weui-loadmore').eq($(this).index()).removeClass('none');
        }
        return false;
    })

    //分类切换
    $('.classify-main li').click(function(){
        if($(this).hasClass('active')){
            return false;
        }
        $('.classify-main li').removeClass('active');
        $(this).addClass('active');
        $('.classify-display').hide();
        $('#classify-'+$(this).data('id')).show();
        return false;
    })
})
var tools = {
    ajax: function(params){
        $.ajax({
            url: params.url,
            type: params.type,
            dataType: params.dataType,
            data: params.data,
            beforeSend: params.beforeSend ? params.beforeSend : function(){},
            success: params.success,
            error: params.error ? params.error : function(){},
            complete: params.complete ? params.complete : function(){}
        })
    },
    validate: {
        mobile: function(mobile){        
            return /^1[3|4|5|7|8][0-9]{9}$/.test(mobile);
        },
        email: function(email){
            return /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test(email);
        }
    }
}