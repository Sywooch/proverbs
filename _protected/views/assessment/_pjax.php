<?php
$uid = json_encode($model->id);
$upd = json_encode($model->updated_at);
$pjaxInt = json_encode(Yii::$app->params['pjaxInterval']);
$pjax = <<< JS
$(document).ready(function(){
    var uid;
    var val;
    var ini = true;

	$('#assessment-info-menu .ui.menu')
    .on('click', '.item', function() {
        $(this).addClass('active').siblings('.item').removeClass('active');
        var sel = $(this).attr('data-tab');
        var tab = $('.ui.tab.segment');
        var t = $('#assessment-info-menu').find('[data-tab=\"' + sel + '\"]');
        $(t).addClass('active').removeClass('hidden').siblings('.ui.tab.segment').removeClass('active');
    });

    function pjax(data){
        $('.ui.inverted.dimmer').addClass('active');
        $.pjax.reload({container:'#assessment-card'});
        setTimeout(function(){
            $.pjax.reload({container:'#assessment-detail',clientOptions: setTab()});
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

    function setTab(){
        
        setTimeout(function(){
            var sel = $('#assessment-info-menu .ui.menu > .item.active').attr('data-tab');
            var t =  $('#assessment-info-menu > #assessment-detail').find('[data-tab=\"' + sel + '\"]');
            t.addClass('active').siblings('.ui.tab.segment').removeClass('active');
        },200);

        setTimeout(function(){
            state();
        },2200);
    }

    setInterval(function(){
        $.ajax({
            type: 'POST',
            url: 'pjax?data=' + JSON.stringify({
                    uid: $uid,
                    upd: getUpd(),
                }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
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