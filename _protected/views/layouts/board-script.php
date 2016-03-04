<?php
if(!Yii::$app->user->isGuest && Yii::$app->user->is('parent') === 1){
    '';
} else {
$script = <<< JS
$(document).ready(function() {

$('#new-board-message').click(function(){
        scrollBottom();
    }
);

function scrollPos()
{
    $("#message-content-panel").scroll(function(){
        //console.log('value: ' + ($("#message-content-panel").scrollTop() - $("#message-content-panel").offset().top));
        return $("#message-content-panel").scrollTop() - $("#message-content-panel").offset().top;
    });
}

function scrollBottom()
{
    $("#message-content-panel").scrollTop($("#message-content-panel")[0].scrollHeight);
}

function reloadLink()
{
    $("#pjax-board").click();
}

function focus()
{
    $(document).on('ready pjax:success', function() {

        var focused = $("#write-textarea").is(":focus");
        
        $('#scroll-to-new-post').click(function(){
                scrollBottom();
            }
        );

        if(focused === true){
            $('#write-textarea').focus();
        } else {
            $('#write-textarea').focus();
        }
    });
}

scrollPos();
scrollBottom();

setInterval(function(){
    reloadLink();
    focus();
}, 5000);
});
JS;
$this->registerJs($script);
    }
?>

<?php
if(!Yii::$app->user->isGuest && Yii::$app->user->is('parent') === 1){
    '';
} else {
$main = <<< JS
$(document).ready(function(){

var btn_remove = $('#btn-msg-toggle');
var msg = $('#toggle-board-menu');
var board = $('#messages');
var main_content = $('#main-content');
var msg_collapsed = true;

    function hideMsg(){
        board.hide();
    }
    
    function showMsg(){
        board.show();
    }

    btn_remove.click(function(){
        msg_collapsed = true;
        hideMsg();
        msg.show();
    });

    msg.click(function(){
        if(msg_collapsed){
            msg_collapsed = false;
            msg.hide();
            showMsg();
            $("#message-content-panel").scrollTop($("#message-content-panel")[0].scrollHeight);
        }else {
            msg_collapsed = true;
            hideMsg();
        }
    });
});
JS;
$this->registerJs($main);
}
?>