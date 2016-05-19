<?php
$timeOut = 60000;
$success = Yii::$app->session->getFlash('success');
if($success !== null){
$timeOut = json_encode($timeOut);
$success = json_encode($success);
$toast = <<< JS
$(document).ready(function(){
    function showToast(){
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-center",
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": $timeOut,
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };
        
        toastr.success($success,'Success!');
    }
    showToast();
});
JS;
$this->registerJs($toast);
}
?>
<?php
$timeOut = 60000;
$success2 = Yii::$app->session->getFlash('success2');
if($success2 !== null){
$timeOut = json_encode($timeOut);
$success2 = json_encode($success2);
$toast2 = <<< JS
$(document).ready(function(){
    function showToast(){
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-center",
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": $timeOut,
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };
        toastr.success($success2,'Success!');
    }
    setTimeout(function(){
      showToast();
    }, 500);
});
JS;
$this->registerJs($toast2);
}
?>
<?php
$timeOut = 60000;
$error = Yii::$app->session->getFlash('error');
if($error !== null){
$timeOut = json_encode($timeOut);
$error = json_encode($error);
$toast3 = <<< JS
$(document).ready(function(){
    function showToast(){
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-center",
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": $timeOut,
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };
        
        toastr.error($error, 'Error!');
    }
    showToast();
});
JS;
$this->registerJs($toast3);
}
?>