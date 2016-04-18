<?php
$script = <<< JS
$(document).ready(function(){

function trigger(){
    setTimeout(function(){ $('#trig1').click(); },1000);
    setTimeout(function(){ $('#trig2').click(); },2000);
    setTimeout(function(){ $('#trig3').click(); },3000);
    setTimeout(function(){ $('#trig4').click(); },4000);
    setTimeout(function(){ $('#trig5').click(); },5000);
}

setInterval(function(){
    trigger();
}, 10000);

$(document).on('click', '#trig1', function(e){
    $.pjax.reload({container:'#applicant-list1'});
});

$(document).on('click', '#trig2', function(e){
    $.pjax.reload({container:'#applicant-list2'});
});

$(document).on('click', '#trig3', function(e){
    $.pjax.reload({container:'#applicant-list3'});
});

$(document).on('click', '#trig4', function(e){
    $.pjax.reload({container:'#applicant-list4'});
});

$(document).on('click', '#trig5', function(e){
    $.pjax.reload({container:'#applicant-list5'});
});



});
JS;
$this->registerJs($script);
?>