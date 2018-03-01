/**
 * 站点信息管理
 * @authors Amos (szhcool1129@sina.com)
 * @date    2017-09-23 12:57:37
 * @version $Id$
 */

page === 'addSiteInfo' && UE.getEditor("container");

$(document).ready(function () {
    var e = $(".add-form"),
        r = $(".alert-danger", e),
        i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            title: {
                required: '分类名称不能为空'
            }
        },
        rules: {
            title: {
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
            i.show();
            r.hide();
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.add-form').serialize(),
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
})