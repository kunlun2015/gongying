/**
 * 用户信息管理
 * @authors Amos (735767227@qq.com)
 * @date    2017-04-20 14:55:11
 * @version $Id$
 */

jQuery(document).ready(function() {
    $(document.body).addClass('page-container-bg-solid');
    //修改密码
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
    //修改个人信息
    var e = $(".basic-info-form"),
    r = $(".alert-danger", e),
    i = $(".alert-success", e);
    e.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        messages: {
            realname: {
                required: '真实姓名不能为空',
                minlength: '真实姓名不能少于2个汉字',
                maxlength: '真实姓名不能多于于4个汉字',
            },
            mobile:{
                isMobile: '手机号码填写不正确'
            }
        },
        rules: {
            realname: {
                required: !0,
                minlength: 2,
                maxlength: 4
            },
            mobile:{
                isMobile: !0
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
                data: $('.basic-info-form').serialize(),
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
    //修改头像
    $('.profile-userpic img').click(function(){
        $('#avatarEditModal').modal('show');
        return false;
    })

    var avatarChanged = false;
    $('#avatarInput').on('change', function(e) {
        var filemaxsize = 1024 * 5;//5M
        var target = $(e.target);
        var Size = target[0].files[0].size / 1024;
        if(Size > filemaxsize) {
            alert('图片过大，请重新选择!');
            $(".avatar-wrapper").childre().remove;
            return false;
        }
        if(!this.files[0].type.match(/image.*/)) {
            alert('请选择正确的图片!')
        } else {
            var filename = document.querySelector("#avatar-name");
            var texts = document.querySelector("#avatarInput").value;
            var teststr = texts;
            testend = teststr.match(/[^\\]+\.[^\(]+/i);
            filename.innerHTML = testend;
            avatarChanged = true;
        }    
    });

    $(".avatar-save").on("click", function() {
        if(!avatarChanged){
            layer.alert('您还没有选择头像图片哦！', {title: siteName+'提示您：', icon: 2});
            return false;
        }
        var img_lg = document.getElementById('imageHead');
        // 截图小的显示框内的内容
        html2canvas(img_lg, {
            allowTaint: true,
            taintTest: false,
            onrendered: function(canvas) {
                canvas.id = "mycanvas";
                //生成base64图片数据
                var base64 = canvas.toDataURL("image/jpeg");
                var formData = $('.avatar-form').serializeArray();
                formData.push({name:'base64', value:base64});
                $.ajax({
                    url: $("input[name=avatar_request_url]").val(),
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function(res){
                        if(res.code === 0){
                            layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(index){
                                $('.layout-avatar').attr('src', res.data.path);
                                $('.profile-userpic img').attr('src', res.data.path);
                                $('#avatarEditModal').modal('hide');
                                layer.close(index);
                            });
                        }else{
                            layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
                        }
                    }
                })
            }
        });
    })
})