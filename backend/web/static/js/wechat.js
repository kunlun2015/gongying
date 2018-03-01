/**
 * wechat
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-01-31 15:59:02
 * @version $Id$
 */
$(document).ready(function(){
    //微信账号    
    var e = $(".account-form"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            name: {
                required: '名称不能为空'
            },
            wx_id: {
                required: '微信号不能为空'
            },
            appID: {
                required: 'appID不能为空'
            },
            appsecret: {
                required: 'appsecret不能为空'
            }
        },
        rules: {
            name: {
                required: !0
            },
            wx_id: {
                required: !0
            },
            appID: {
                required: !0
            },
            appsecret: {
                required: !0
            }
        },
        invalidHandler: function(e, t) {
            i.hide(),
            r.show(),
            App.scrollTo(r, -200)
        },
        highlight: function(e) {
            $(e).closest(".form-group").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group").removeClass("has-error")
        },
        success: function(e) {
            e.closest(".form-group").removeClass("has-error")
        },
        submitHandler: function(e) {
            i.show(),
            r.hide()       
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.account-form').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            window.location.href = res.data.url;
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })

    //微信账号    
    var e = $(".replyKeywords-form"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            keywords: {
                required: '关键字不能为空'
            },
            type: {
                required: '请选择回复类型'
            }
        },
        rules: {
            keywords: {
                required: !0
            },
            type: {
                required: !0
            }
        },
        invalidHandler: function(e, t) {
            i.hide(),
            r.show(),
            App.scrollTo(r, -200)
        },
        highlight: function(e) {
            $(e).closest(".form-group").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group").removeClass("has-error")
        },
        success: function(e) {
            e.closest(".form-group").removeClass("has-error")
        },
        submitHandler: function(e) {
            i.show(),
            r.hide()       
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.replyKeywords-form').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            window.location.href = res.data.url;
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })

    //选择回复类型
    $('.reply-type').change(function(){
        $('.reply-type-list').addClass('none');
        if($(this).val()){            
            $('.reply-'+$(this).val()).removeClass('none');
        }
        return false;
    })
})