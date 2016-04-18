<?php
$script = <<< JS
$(document).ready(function(){

function trigger(){
    setTimeout(function(){ $('#trig1').click(); },1000);
}

setInterval(function(){
    trigger();
}, 10000);

$(document).on('click', '#trig', function(e){
    $.pjax.reload({container:'#user-list'});
});
});
JS;
$this->registerJs($script);
?>