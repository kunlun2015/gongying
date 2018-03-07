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
            success: params.success,
            error: params.error ? params.error : function(){}
        })
    }
}