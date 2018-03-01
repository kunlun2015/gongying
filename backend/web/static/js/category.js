/**
 * category manage
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-27 09:09:12
 * @version $Id$
 */
$(document).ready(function(){
    var e = $(".add-category-form"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            name: {
                required: '分类名称不能为空'
            },
            sort: {
                number: '排序只能为数字'
            }
        },
        rules: {
            name: {
                required: !0
            },
            sort: {
                number: true
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
                data: $('.add-category-form').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            history.back();
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })
    //删除分类
    $('.delete').click(function(){
        var _this = $(this);
        layer.confirm('确定要删除吗', {title: siteName+'提示您：', icon: 3}, function(){        
            var formData = {act: 'delete', id: _this.data('id')};
            formData[$("meta[name=csrf-param]")[0].content] = $("meta[name=csrf-token]")[0].content;
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            _this.parent().parent().remove();
                            layer.close(index);
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        })
        return false;
    })    
})