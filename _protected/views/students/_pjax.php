<?php
$script = <<< JS
$(document).ready(function(){
setInterval(function(){
    $('#trig').click();
}, 5000);
$(document).on('click', '#trig', function(e){
    $.pjax.reload({container:'#student-list'});
});
});
JS;
$this->registerJs($script);
?>