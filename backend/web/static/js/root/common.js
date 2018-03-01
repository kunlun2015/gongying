/**
 * common js
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-27 14:59:06
 * @version $Id$
 */

var siteName = 'kl_系统';

//退出登录
$('.log-out').click(function(){
    var _this = $(this);
    layer.confirm('确定要退出吗？', {title: siteName+'提示您：', icon: 3}, function(){
        $.ajax({
            url: _this.attr('href'),
            type: 'get',
            dataType: 'json',
            success: function(res){
                if(res.code == 0){
                    window.location.href = res.data.url;
                }else{
                    layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                }
            }
        })
    })    
    return false;
})

//返回
$('.history-back').click(function(){
    window.history.back();
    return false;
})