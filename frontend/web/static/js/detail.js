/**
 * published show
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-13 10:53:16
 * @version $Id$
 */

$(document).ready(function(){

    $('.btn-collect').click(function(){
        var _this = $(this);
        tools.ajax({
            url: '/detail/collect',
            dataType: 'json',
            type: 'post',
            data: {pid: $("input[name=publishedId]").val()},
            success: function(res){
                if(res.code === 0){
                    $.toast(res.msg, 1000, function(){
                        if(res.data.status == 0){
                            _this.children('i').removeClass('fa-star').addClass('fa-star-o');
                        }else if(res.data.status == 1){
                            _this.children('i').removeClass('fa-star-o').addClass('fa-star');
                        }
                    });
                }else{
                    $.toast(res.msg, 'cancel');
                }
            }
        })
        return false;
    })
})