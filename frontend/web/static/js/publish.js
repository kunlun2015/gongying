/**
 * puhlish
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-04 11:59:33
 * @version 1.0
 */
$(document).ready(function(){
    $("#city-picker").cityPicker({
        title: "请选择收货地址"
    });
    $("#datetime-picker").datetimePicker({
        times: function () {
          return [];
        }
    });
    $("input[name=classify]").click(function(){        
        $("input[name=classify-1]").select('open');
    })
    //所属分类1
    var classify1 = [];
    var classify2 = [];
    var classify3 = [];
    for(var i in classify){
        if(classify[i]['pid'] == 0){
            classify1.push({value: classify[i]['id'], title: classify[i]['name']});
        }
    }
    $("input[name=classify-1]").select({
        title: "选择职业",
        items: classify1,
        onChange: function(e){
            classify2 = [];
            for(var i in classify){
                for(var ii in classify[i].sub){
                    if(classify[i].sub[ii].pid == e.values){
                        classify2.push({value: classify[i].sub[ii].id, title: classify[i].sub[ii].name});
                    }
                }
            }
            $("input[name=classify-2]").select('update', {
                items: classify2
            });
        },
        beforeClose: function(e){
            if(e === undefined){
                $.alert("请选择所属分类");
                return false;
            }
            $('input[name="fid"]').val(e);
        },
        onClose: function(){
            $("input[name=classify-2]").select('open');
        }
    });

    $("input[name=classify-2]").select({
        title: "选择职业",
        items: classify2,
        onChange: function(e){
            classify3 = [];
            for(var i in classify){
                for(var ii in classify[i].sub){
                    for(var iii in classify[i].sub[ii].sub){
                        if(classify[i].sub[ii].sub[iii].pid == e.values){
                            classify3.push({value: classify[i].sub[ii].sub[iii].id, title: classify[i].sub[ii].sub[iii].name});
                        }
                    }
                }
            }
            $("input[name=classify-3]").select('update', {
                items: classify3
            });
        },
        beforeClose: function(e){
            if(e === undefined){
                $.alert("请选择所属分类");
                return false;
            }
            $('input[name="sid"]').val(e);
        },
        onClose: function(){
            $("input[name=classify-3]").select('open');
        }
    });

    $("input[name=classify-3]").select({
        title: "选择职业",
        items: classify3,
        beforeClose: function(e){
            if(e === undefined){
                $.alert("请选择所属分类");
                return false;
            }
            $("input[name=classify]").val($("input[name=classify-1]").val()+'>'+$("input[name=classify-2]").val()+'>'+$("input[name=classify-3]").val());
            $('input[name="tid"]').val(e);
        }
    });

    $('.description').on('input', function(){
        var counter = $('.description-counter')[0].innerText;
        var counterLength = counter.split('/');
        var curLength = Number($('.description').val().length);
        var totalLength = Number(counterLength[1]);
        $('.description-counter')[0].innerText = curLength+'/'+totalLength;
        if(curLength > totalLength){
            $('.description-counter')[0].innerText = totalLength+'/'+totalLength;
            $('.description').val($('.description').val().substr(0, totalLength));
            return false;
        }
    })

    var uploadNum = $('.weui-uploader__info').text().split('/')[1];
    var config = {
        enabled: true,
        customered: true,
        multipleFiles: true,
        autoRemoveCompleted: false,
        autoUploading: true,
        fileFieldName: "uploaderInput",
        maxSize: 1024*1024*10,
        simLimit: uploadNum,
        extFilters: [".jpg", ".png", ".jpeg"],
        browseFileId : "uploaderInput",
        filesQueueId : "i_stream_files_queue",
        uploadURL : "/upload/picture",
        tokenURL: '/upload/token',
        retryCount: 1,
        onSelect: function(files) {},
        onMaxSizeExceed: function(file) {
            console.log('文件过大')
        },
        onExtNameMismatch: function(info) {
            console.log('文件类型不匹配');
        },
        onAddTask: function(file) {
            var str = '<li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./static/images/pic_160.png)"><div class="weui-uploader__file-content">0%</div><input type="hidden" name="pictures[]" /></li>';
            $('#uploaderFiles').append(str);  
        },
        onUploadProgress: function(file) {
            $('.weui-uploader__file_status .weui-uploader__file-content').text(file.percent + "%");
        },
        onStop: function() {},
        onCancel: function(file) {},
        onCancelAll: function(numbers) {},
        onComplete: function(file) {
            $('.weui-uploader__file_status .weui-uploader__file-content').text("100%");
            $('.weui-uploader__file_status').css({'background-image': 'url("'+JSON.parse(file.msg).url+'")'})
             $('.weui-uploader__file_status input').val(JSON.parse(file.msg).path);
            $('.weui-uploader__file_status').removeClass('weui-uploader__file_status');
            $('.weui-uploader__info').text($('.weui-uploader__file').length+'/'+uploadNum);
        },
        onFileCountExceed: function(){
            console.log('文件数量超过限制');
        },
        onRepeatedFile: function(file){
            return true;
        },
        onQueueComplete: function(msg) {},
        onUploadError: function(status, msg) {}
    };
    var _t = new Stream(config);

    var clickedUploadPicture;
    //查看上传图片
    $('#uploaderFiles').on("click", "li", function(){
        clickedUploadPicture = $(this);
        $('#galleryImg').attr("style", this.getAttribute("style"));
        $('#gallery').fadeIn(100);
        return false;
    });
    
    $('.weui-gallery__img').on("click", function(){
        $('#gallery').fadeOut(100);
        return false;
    });
    //删除已上传的图片
    $(document).on('click', '.weui-icon_gallery-delete', function(){
        clickedUploadPicture.remove();
        $('#gallery').fadeOut(100);
        return false;
    })

    //保存表单
    $('.save-btn').click(function(){
        if(!$("input[name=title]").val()){
            $.alert("请输入采购物资名称", function(){
                $("input[name=title]").focus()
            });
            return false;
        }
        tools.ajax({
            url: '/publish/save',
            dataType: 'json',
            type: 'post',
            data: $('.publish-form form').serialize(),
            success: function(res){
                if(res.code === 0){
                    $.toast(res.msg, 1000, function(){
                        window.location.href = res.data.url
                    });
                }
            }
        })
    })
})