/**
 * post
 * @authors Amos (735767227@qq.com)
 * @date    2017-08-01 10:02:26
 * @version $Id$
 */

if(page === 'addPost'){
    var ue = UE.getEditor("container");
}

$(document).ready(function () {
    var e = $(".add-post-form"),
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
            abstract: {
                required: '文章摘要不能为空'
            }
        },
        rules: {
            name: {
                required: !0
            },
            abstract: {
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
            var lastCate = $("select[name='cate[]']:last");
            if(!lastCate.val()){
                layer.alert('分类选择不完整', {title: siteName+'提示您：', icon: 2});
                return false;
            }
            $.ajax({
                url: $("input[name=request_url]").val(),
                type: 'post',
                dataType: 'json',
                data: $('.add-post-form').serialize(),
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
})

//上传文章封面
$('.select-thumbnail-btn').click(function(){
    $('#post-thumbnail-input').click();
})
//上传banner轮播图
var precessLayer;
var uploadFormData = {act: 'upload'};
uploadFormData[$('#csrf').attr('name')] = $('#csrf').val();
"undefined" != typeof page && page === 'addPost' && $('#post-thumbnail-input').fileupload({
    url: $("input[name=request_url]").val(),
    dataType: 'json',
    formData: uploadFormData,
    add: function(e, data){
        precessLayer = layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: ['500px', '80px'],
            content: '<div class="upload-process"><div class="title">文件正在上传请稍候</div><div class="process-bar"><div class="progress-precent"></div></div></div>'
        });
        data.submit();
    },
    done: function (e, res) {
        if(res.result.code === 0){
            layer.close(precessLayer);
            $("input[name=thumbnail]").val(res.result.data.path);
        }else{

        }
    },
    progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('.upload-process .progress-precent').css('width', progress+'%');
        $('.upload-process .progress-precent').text(progress+'%');
    }
}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

//预览图片
$("input[name=thumbnail]").hover(function () {
    var picturePath = $(this).val();
    return false;
})

//选择分类
$(document).on('change', "select[name='cate[]']", function () {
    var _this = $(this);
    var pid = _this.val();
    _this.next().remove();
    if(!pid){
        return false;
    }
    var formData = {act: 'cate', pid: pid};
    formData[$("meta[name=csrf-param]")[0].content] = $("meta[name=csrf-token]")[0].content;
    $.ajax({
        url: $("input[name=request_url]").val(),
        type: 'post',
        dataType: 'json',
        data: formData,
        success: function(res){
            if(res.code == 0){
                var str = '<select name="cate[]" class="form-control input-inline"><option value="">请选择所属分类</option>';
                $.each(res.data, function (index, val) {
                    str += '<option value="'+val.id+'">'+val.name+'</option>';
                })
                str += '</select>';
                _this.after(str);
            }else{
                console.log(res.msg);
            }
        }
    })
})

//推荐文章
$('.recommend').click(function(){
    var _this = $(this);
    layer.open({
        type: 2,
        title: '推荐文章',
        shadeClose: false,
        shade: 0.8,
        area: ['500px', '320px'],
        content: _this.attr('href')
    });
    return false;
})
//关闭推荐层
$('.close-layer').click(function(){
    parent.layer.close(parent.layer.getFrameIndex(window.name));
    return false;
})
//推荐提交
$('.submit-recommend').click(function(){
    var recommendType = $("input[name=recommend_type]:checked").val();
    if(typeof(recommendType) === 'undefined'){
        layer.alert('请选择要推荐到的位置', {title: siteName+'提示您：', icon: 2});
        return false;
    }
    $.ajax({
        url: $("input[name=request_url]").val(),
        dataType: 'json',
        type: 'post',
        data: $('.recommend-post-form').serialize(),
        success: function(res){
            if(res.code == 0){
                layer.alert(res.msg, {title: siteName+'提示您：', icon: 1}, function(){
                    layer.closeAll();
                    parent.layer.close(parent.layer.getFrameIndex(window.name));
                });
            }else{
                layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
            }
        }
    })
    return false;
})

//列表页更改状态按钮
$(".change-status-btn, .change-status-act").hover(function(){
    $(this).parent("td").children("a").hide();
    $(this).parent("td").children(".change-status-act").show();
}, function(){
    $(this).parent("td").children("a").show();
    $(this).parent("td").children(".change-status-act").hide();
})

//更改状态
$('.change-status-act a').click(function(){
    var _this = $(this);
    var status = _this.data('status');
    var formData = {act: 'changeStatus', id: _this.data('id'), 'status': status};
    formData[$("meta[name=csrf-param]")[0].content] = $("meta[name=csrf-token]")[0].content;
    $.ajax({
        url: $("input[name=request_url]").val(),
        type: 'post',
        dataType: 'json',
        data: formData,
        success: function(res){
            if(res.code == 0){
                layer.alert(res.msg, {title: siteName+'提示您：', icon: 1});
                var newStatus = '';
                if(status == 0){
                    newStatus = '<span class="label label-sm label-success"> 正常 </span>';
                }else if(status == -1){
                    newStatus = '<span class="label label-sm label-warning"> 审核中 </span>';
                }else if(status == -2){
                    newStatus = '<span class="label label-sm label-danger"> 禁用 </span>';
                }
                _this.parents('tr').find('.post-status').html(newStatus);
            }else{
                layer.alert(res.msg, {title: siteName+'提示您：', icon: 2});
            }
        }
    })
    return false;
})

document.domain='debugphp.com';
function klStyle(){
    layer.open({
        type: 2,
        area: ['525px', '600px'],
        title: '自定义编辑器样式',
        shade: 0.6,
        maxmin: true,
        anim: 1,
        content: 'http://editor.debugphp.com'
    });
}
