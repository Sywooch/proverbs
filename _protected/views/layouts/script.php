<?php
use app\models\DataCenter;

$poll = json_encode(DataCenter::countAnnouncement());
$annInt = json_encode(Yii::$app->params['announcementInterval']);
$impact_url = json_encode(Yii::$app->request->baseUrl . '/site/impact');
$fetch_url = json_encode(Yii::$app->request->baseUrl . '/site/fetch-announcement?data=');
$push_url = json_encode(Yii::$app->request->baseUrl . '/site/new-announcement?data=');
$del_url = json_encode(Yii::$app->request->baseUrl . '/site/delete-announcement?id=');

$write = <<< JS
$(document).ready(function(){
    var val;
    var ini = true;

    var fa = $('#new-announcement');
    var mt = $('#modal-target');
    var sa = $('#announcement-sidebar');
    var tf = $('#ann-form');
    var anc_send = $('#anc-send');
    var a = $('.anc-delete');


    //FETCH ON IMPACT    
    if(ini){
        impact();
        ini = false;
    }

    //SETTERS & GETTERS
    function getIni(data){
        return ini;
    }

    function setIni(data){
        ini = data;
    }

    function getPoll(){
        if(ini){
            return $poll;
        }else {
            return val;
        }
    }

    //IMPACT
    function impact(){
        $.ajax({
            type: 'POST',
            url: $impact_url,
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data){
                console.log(data);
                run(data);
                setTimeout(function(){
                    $('.modal-body > .ui.dimmer').remove();
                },2000);
            },
        });
    }

    //FETCH
    function fetch(){
        $.ajax({
            type: 'POST',
            url: $fetch_url + JSON.stringify({
                poll: getPoll(),
            }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data){
                console.log(data);
                run(data);
                setTimeout(function(){
                    $('.modal-body > .ui.dimmer').remove();
                }, 2000);
            },
        });
    }

    //GET CURRENT COUNT
    function getCurrentCount(){
        return count;
    }

    //RUN
    function run(data){
        $(mt).append(data['announcement-modal'].content);
        $(sa).append(data['announcement'].content);
    }
});
JS;
$this->registerJs($write);
?>