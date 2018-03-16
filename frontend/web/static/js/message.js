/**
 * message
 * @authors Amos (735767227@qq.com)
 * @date    2018-03-15 15:11:40
 * @version $Id$
 */

$(function(){
    $('.btn-send').click(function(){
        var message = $('.message-input').val();
        tools.ajax({
            url: '/message/send',
            dataType: 'json',
            type: 'post',
            data: {message: message, tuid: $("input[name=tuid]").val()},
            beforeSend: function(){
                if(!message){
                    $.alert("请输入您要发送的内容", function(){
                        $('.message-input').focus();
                    });
                    return false;
                }
            },
            success: function(res){
                if(res.code == 0){
                    $("input[name='rid']").val(res.data.rid);
                    var html = '<div class="message me"><div class="avatar"><img src="'+$("input[name='avatar']").val()+'" alt=""></div><div class="content"><p class="author-name">'+$("input[name='username']").val()+'</p><div class="message-text-wrap"><div class="message-text">'+res.data.message+'</div></div></div></div>';
                    $('.chat').append(html);
                }else{

                }
            }
        })
        return false;
    })
})