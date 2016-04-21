<?php
$script = <<< JS
$(document).ready(function(){
    setInterval(function(){
        $.pjax.reload({container:'#entrance-exam-card'});
        setTimeout(function(){
            $.pjax.reload({container:'#entrance-exam-detail'})
        }, 1000);
    }, 10000);
});
JS;
$this->registerJs($script);
?>