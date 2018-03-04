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
})