<?php
$uid = json_encode($model->id);
$upd = json_encode($model->updated_at);
$pjaxInt = json_encode(Yii::$app->params['pjaxInterval']);
$pjax = <<< JS
$(document).ready(function(){
    var uid;
    var val;
    var ini = true;

    function pjax(data){
        $('.ui.inverted.dimmer').addClass('active');
        $.pjax.reload({container:'#class-adviser-card'});
        setTimeout(function(){
            $.pjax.reload({container:'#class-adviser-detail',clientOptions: run()});
        }, 1000);
    }

    function getIni(data){
        return ini;
    }

    function setIni(data){
        ini = data; 
    }

    function getUpd(){
        if(ini){
            return $upd;
        }else {
            return val;
        }
    }

    function state(){
        $('.ui.inverted.dimmer').removeClass('active');
    }

    function run(){
        setTimeout(function(){
            state();
        },2200);
    }

    setInterval(function(){
        $.ajax({
            type: 'POST',
            url: 'pjax?data=' + JSON.stringify({
                    uid:$uid,
                    upd:getUpd(),
                }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.pjax){
                    pjax();
                    if(data.delta){
                        val = data.upd;
                        setIni(false);
                    }
                }
            }
        });
    }, $pjaxInt);
});
JS;
$this->registerJs($pjax);
?>