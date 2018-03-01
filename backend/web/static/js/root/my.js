/**
 * 用户信息管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-24 16:55:19
 * @version $Id$
 */

jQuery(document).ready(function() {
    var e = $("#edit-password"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            password_old: {
                required: '请填写您的旧密码',
                minlength: '密码不能少于6位字符'
            },
            password: {
                required: '您输入新的登录密码',
                minlength: '密码不能少于6位字符'
            },
            password_confirm: {
                equalTo: '两次登陆密码不一致' 
            }
        },
        rules: {
            password_old: {
                required: !0,
                minlength: 6
            },
            password: {
                required: !0,
                minlength: 6
            },
            password_confirm: {
                equalTo: '#password'
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
                data: $('#edit-password').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1});
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    }) 
});