/**
 * 用户管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-03-28 14:42:44
 * @version $Id$
 */

$(document).ready(function(){
    $("#sample_1").dataTable({
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        language: {
            emptyTable: "暂无用户数据" 
        },
        columnDefs: [{
            orderable: !1,
            targets: [0]
        }],
        order: []
    });
    //添加用户
    var e = $(".add-user-form"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            username:{
                required: '请输入要添加的用户名',
                minlength: '用户名不能少于4位'
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
            username: {
                required: !0,
                minlength: 4
            },
            mobile:{
                isMobile: true
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
                data: $('.add-user-form').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(layer){
                            window.location.href = res.data.url;
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })

    //编辑用户
    var e = $(".edit-user-form"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            realname: {
                maxlength: '真实姓名不能多于四个字'
            }
        },
        rules: {
            realname: {
                maxlength: 4
            },
            mobile:{
                isMobile: true
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
                data: $('.edit-user-form').serialize(),
                success: function(res){
                    if(res.code == 0){
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(layer){
                            window.location.href = res.data.url;
                        });
                    }else{
                        layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                    }
                }
            })
        }
    })

    //权限管理   
    "undefined" != typeof treeMenuData && $("#tree-authority").jstree({
        plugins: ["wholerow", "checkbox", "types"],
        core: {
            themes: {
                responsive: !1
            },
            data: treeMenuData
        },
        types: {
            "default": {
                icon: "fa fa-folder icon-state-warning icon-lg"
            },
            file: {
                icon: "fa fa-file icon-state-warning icon-lg"
            }
        }
    })
    $('#tree-authority').on('ready.jstree', function(){
        $('#tree-authority').jstree(true).select_node(userAuthority);
        $('#tree-authority').jstree(true).open_node(userAuthority);
    })

    $('.submit-authority').click(function(){        
        var selected = $('#tree-authority').jstree().get_checked(true);
        var groupId = [];
        var menuId = [];
        var treeState = $('#tree-authority').jstree(true).get_checked();
        for (var i in selected) {
            $.each(selected[i].parents, function(index, node){
                var treeNode = $('#tree-authority').jstree(true).get_node(node);
                if(treeNode.id !== '#' && $.inArray(treeNode.li_attr.data_id, groupId) === -1 && treeNode.li_attr.class === 'menu-group'){
                    groupId.push(treeNode.li_attr.data_id);
                }else if(treeNode.id !== '#' && $.inArray(treeNode.li_attr.data_id, menuId) === -1 && treeNode.li_attr.class === 'menu-function'){
                    menuId.push(treeNode.li_attr.data_id)
                }
                var curTreeNode = $('#tree-authority').jstree(true).get_node(selected[i].id);
                if(treeNode.id !== '#' && curTreeNode.id !== '#' && $.inArray(curTreeNode.li_attr.data_id, groupId) === -1 && curTreeNode.li_attr.class === 'menu-group'){
                    groupId.push(curTreeNode.li_attr.data_id);
                }else if(treeNode.id !== '#' && curTreeNode.id !== '#' && $.inArray(curTreeNode.li_attr.data_id, menuId) === -1 && treeNode.li_attr.class === 'menu-function'){
                    menuId.push(curTreeNode.li_attr.data_id)
                }

            });            
            if(selected[i].li_attr.class == 'menu-function' && $.inArray(selected[i].li_attr.data_id, menuId) === -1){
                menuId.push(selected[i].li_attr.data_id);
            }else if(selected[i].li_attr.class == 'menu-group' && $.inArray(selected[i].li_attr.data_id, groupId) === -1){
                groupId.push(selected[i].li_attr.data_id);
            }
        }        
        $.ajax({
            url: $("input[name=request_url]").val(),
            dataType: 'json',
            type: 'post',
            data: $('.user-authority-form').serialize()+'&menuGroup='+groupId+'&menuFunction='+menuId+'&treeState='+treeState,
            success: function(res){
                if(res.code == 0){
                    layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(layer){
                        window.location.href = res.data.url;
                    });
                }else{
                    layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                }
            }
        })
        return false;
    })

})