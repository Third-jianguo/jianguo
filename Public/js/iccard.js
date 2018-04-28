/**
 * Created by weidongjun on 2016/10/17.
 */
$(document).ready(function () {
    setInterval('loginTime()', 1000);
})
function loginTime() {
    $.post('__APP__/Home/Out/out', function (data) {
        if (data.status == 0) {

            alert(data.msg);
            window.location.href = '/index.php/Home/Index/index';
        }
    }, 'json')

}
