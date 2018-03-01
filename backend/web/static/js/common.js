/**
 * global js
 * @authors Kunlun (szhcool1129@sina.com)
 * @date    2017-04-09 19:11:29
 * @version $Id$
 */

var siteName = 'kl_系统';

//全局退出
$('.log-out').click(function(){
    var _this = $(this);
    if(layer.confirm('确定要退出吗', {title: siteName+'提示您：', icon: 3}, function(){
        $.ajax({
            url: _this.attr('href'),
            dataType: 'json', 
            type: 'get', 
            success: function(res){
                if(res.code == 0) {
                    layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(layer){
                        window.location.href = res.data.url;
                    })
                }
            }
        })
    }))
    
    return false;
})