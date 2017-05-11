<?php
use yii\bootstrap\Modal;
use yii\helpers\Url;
/**
* login modal 弹窗
*/
Modal::begin([
    //弹窗主体
'id' => 'create-modal',
'header' => '<h4 class="modal-title">登录</h4>',
//    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
//弹窗引入的页面
$requestUrl = Url::toRoute('login');
//js代码
$js = <<<JS
$.get('{$requestUrl}', {},
function (data) {
$('.modal-body').html(data);
}
);
//点击清空提示内容
$(function ($) {
$("#login").on('click', function () {
$(".help-block").html("");
});
});
JS;
$this->registerJs($js);
Modal::end();
?>