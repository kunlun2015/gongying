/**
 * 功能管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-10 17:53:38
 * @version $Id$
 */
$(document).ready(function(){
    $("#sample_1").dataTable({
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        language: {
            emptyTable: "暂无功能数据" 
        },
        order: []
    });
    //添加分组    
    var e = $('.functio-group-add-form'),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            name: {
                required: '请输入分组标题'
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
            var loading = layer.load()
            i.show(),
            r.hide()
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.functio-group-add-form').serialize(),
                success: function(res){
                    layer.close(loading);
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            layer.close(index);
                            window.location.reload();
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })
    //编辑分组
    $('.edit-function-group').click(function(){
        var _this = $(this);
        var loading = layer.load();
        $.ajax({
            url: _this.attr('href'),
            dataType: 'json',
            data: {groupid: _this.data('id')},
            success: function(res){ 
                if(res.code == 0){
                    $("#functio-group-edit-modal input[name=groupid]").val(res.data.id);
                    $("#functio-group-edit-modal input[name=name]").val(res.data.name);
                    $("#functio-group-edit-modal input[name=sort]").val(res.data.sort);
                    $("#functio-group-edit-modal textarea[name=remarks]").val(res.data.remarks);
                    $('.group-status').eq(Number(res.data.status)).iCheck('check');
                    $('#functio-group-edit-modal').modal('show');
                }
                layer.close(loading);
            }
        })
        return false;
    })
    var e = $('.functio-group-edit-form'),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            name: {
                required: '请输入分组标题'
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
            var loading = layer.load()
            i.show(),
            r.hide()
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.functio-group-edit-form').serialize(),
                success: function(res){
                    layer.close(loading);
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            layer.close(index);
                            window.location.reload();
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })
    //删除分组
    $('.delete-function-group').click(function(){
        var _this = $(this);
        layer.confirm('确定要删除分组吗？删除分组将会同时删除分组下的菜单且不可恢复，请谨慎操作！', {title: siteName+'提示您：', icon: 3}, function(index){
            var loading = layer.load();
            $.ajax({
                url: _this.attr('href'),
                type: 'get',
                dataType: 'json',
                data: {act: 'deleteGroup', groupid: _this.data('id')},
                success: function(res){
                    layer.close(loading);
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            layer.close(index);
                            window.location.reload();
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        })
        return false;
    })
    //添加功能菜单
    var e = $('.add-function-form'),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            name: {
                required: '请输入菜单名称'
            },
            controller:{
                required: '控制器不能为空'
            },
            method:{
                required: '方法不能为空'
            },
            sort: {
                number: '排序只能为数字'
            }
        },
        rules: {
            name: {
                required: !0
            },
            controller: {
                required: !0
            },
            method:{
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
            var loading = layer.load()
            i.show(),
            r.hide()
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.add-function-form').serialize(),
                success: function(res){
                    layer.close(loading);
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            layer.close(index);
                            window.location.href = res.data.url;
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })
    //编辑功能菜单
    var e = $('.edit-function-form'),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            name: {
                required: '请输入菜单名称'
            },
            controller:{
                required: '控制器不能为空'
            },
            method:{
                required: '方法不能为空'
            },
            sort: {
                number: '排序只能为数字'
            }
        },
        rules: {
            name: {
                required: !0
            },
            controller: {
                required: !0
            },
            method:{
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
            var loading = layer.load()
            i.show(),
            r.hide()
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.edit-function-form').serialize(),
                success: function(res){
                    layer.close(loading);
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            layer.close(index);
                            window.location.href = res.data.url;
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })
    //删除功能菜单
    $('.del-function-menu').click(function(){
        var _this = $(this);
        layer.confirm('确定要删除功能菜单吗？删除功能菜单将会同时删除此菜单下的菜单且不可恢复，请谨慎操作！', {title: siteName+'提示您：', icon: 3}, function(index){
            var loading = layer.load();
            $.ajax({
                url: _this.attr('href'),
                type: 'get',
                dataType: 'json',
                data: {act: 'deleteFunction', id: _this.data('id')},
                success: function(res){
                    layer.close(loading);
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                            layer.close(index);
                            _this.parent().parent().remove();
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