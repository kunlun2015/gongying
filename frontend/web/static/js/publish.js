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
    $("#datetime-picker").datetimePicker();

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

        var config = {
        enabled: true, /** 是否启用文件选择，默认是true */
        customered: true,
        multipleFiles: true, /** 是否允许同时选择多个文件，默认是false */   
        autoRemoveCompleted: false, /** 是否自动移除已经上传完毕的文件，非自定义UI有效(customered:false)，默认是false */
        autoUploading: true, /** 当选择完文件是否自动上传，默认是true */
        fileFieldName: "uploaderInput", /** 相当于指定<input type="file" name="FileData">，默认是FileData */
        maxSize: 1024*1024*10, /** 当_t.bStreaming = false 时（也就是Flash上传时），2G就是最大的文件上传大小！所以一般需要 */
        simLimit: 1, /** 允许同时选择文件上传的个数（包含已经上传过的） */
        extFilters: [".jpg", ".png", ".jpeg"], /** 默认是全部允许，即 [] */
        browseFileId : "uploaderInput", /** 文件选择的Dom Id，如果不指定，默认是i_select_files */
        filesQueueId : "i_stream_files_queue", /** 文件上传进度显示框ID，非自定义UI有效(customered:false) */
        uploadURL : "/upload/picture",
        tokenURL: '/upload/token',
        retryCount: 1,
        onSelect: function(files) {
        },
        onMaxSizeExceed: function(file) {
            console.log('文件过大')
        },
        onExtNameMismatch: function(info) {
            console.log('文件类型不匹配');
        },
        onAddTask: function(file) {
            var str = '<li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./static/images/pic_160.png)"><div class="weui-uploader__file-content">50%</div></li>';
            $('#uploaderFiles').append(str);  
        },
        onUploadProgress: function(file) {            
            console.log(file.formatLoaded + "/" + file.formatSize + "(" + file.percent + "%" + ") 速  度:" + file.formatSpeed);
            $('.weui-uploader__file_status .weui-uploader__file-content').text(file.percent + "%");
        },
        onStop: function() {},
        onCancel: function(file) {},
        onCancelAll: function(numbers) {},
        onComplete: function(file) {
            $('.weui-uploader__file_status .weui-uploader__file-content').text("100%");
            console.log(file)
            console.log(ile.msg)
            $('.weui-uploader__file_status').css({'background-image': 'url("'+file.msg.url+'")'})
        },
        onQueueComplete: function(msg) {
            //console && console.log("-------------onQueueComplete-------------------");
            //console && console.log(msg);
            //console && console.log("-------------onQueueComplete-------------------End");
        },
        onUploadError: function(status, msg) {
            //console && console.log("-------------onUploadError-------------------");
            //console && console.log(msg + ", 状态码:" + status);
            
            $("#i_error_tips > span.text-message").append(msg + ", 状态码:" + status);
            
            //console && console.log("-------------onUploadError-------------------End");
        }
    };
    var _t = new Stream(config);

    //保存表单
    $('.save-btn').click(function(){

    })


})