<?php
$st = <<< JS
$(document).ready(function(){
    var nme = "";
    var sid = 0;
    var ssid = $('#enroll-profile-id');
    var sname = $('#enroll-profile-name');
    var snick = $('#enroll-profile-nickname');
    var saddr = $('#enroll-profile-address');
    var sbirth = $('#enroll-profile-birth');
    var sage = $('#enroll-profile-age');
    var sinfo = $('#enroll-profile-details');
    var ssped = $('#enroll-profile-sped');
    var simg = $('#enroll-student-profile-image');

    function clear(){
        ssid.html('');
        sname.html('&nbsp;');
        snick.html('&nbsp;');
        saddr.html('&nbsp;');
        sbirth.html('&nbsp;');
        sage.html('&nbsp;');
        ssped.addClass('hidden');
        sinfo.addClass('hidden');
    }

    $("#auto-suggest").change(function () {
        var nme = $('#select2-auto-suggest-container').attr('title');
        var sid = parseInt($(this).find("option:contains(" + nme +")").val());
        var clr = $('#select2-auto-suggest-container');
        
        sinfo.removeClass('hidden');

        if($(clr[0].lastElementChild).text() !== 'Select Student'){
            $.ajax({
                type: "POST",
                url: "card?data=" + JSON.stringify({
                        sid: sid
                    }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    r(data);
                }
            });
        } else {
            clear();
            simg.attr('data-write', false);
            setE();
        }

        function r(data){
            ssid.html('ID#: ' + '<strong>' + data.sid + '</strong>');
            sname.html('<a href="' + data.sid + '">' + data.name + '</a>');
            snick.html(data.nick);
            saddr.html(data.addr);
            sbirth.html(data.bday);

            img(data);

            if(data.spd === 0) {
                ssped.removeClass('hidden');
            } else {
                ssped.addClass('hidden');
            }

            if(data.age === 0 || data.age === 1) {
                sage.html(data.age + ' year old');
            } else {
                sage.html(data.age + ' years old');
            }

            console.log(data.spd);
        }

        function img(data){
            if(data.img === 'empty'){
                setJ();
                setTimeout(function(){ 
                    setD();
                    simg.attr('data-write', false);
                }, 300);

            } else {
                if(simg.attr('data-write') === 'false'){
                    setJ();
                    setTimeout(function(){ 
                        setI(data);
                    }, 300);
                }else {
                    setJ();
                    setTimeout(function(){ 
                        setI(data);
                    }, 300);
                }
            }
        }

        function setD(){
            simg.attr('src', '../uploads/ui/user-blue.png');
            simg.addClass('grow').removeClass('fastShrink').removeClass('hidden');
        }

        function setE(){
            simg.addClass('fastShrink').removeClass('grow');
        }

        function setI(data){
            simg.attr('data-write', true);
            simg.attr('src', data.img);
            simg.addClass('grow').removeClass('fastShrink').removeClass('hidden');
        }

        function setJ(){
            simg.removeClass('grow').addClass('fastShrink');
        }
    });
});
JS;
$this->registerJs($st);
?>