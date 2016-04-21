function handleAjaxLink(e) {

    e.preventDefault();

    var
        $link = $(e.target),
        callUrl = $link.attr('href'),
        formId = $link.data('formId'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        ajaxRequest;

    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: (typeof formId === "string" ? $('#' + formId).serializeArray() : null)
    });

    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
        ajaxRequest.done(ajaxCallbacks[onDone]);
    }

    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
        ajaxRequest.fail(ajaxCallbacks[onFail]);
    }

    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
        ajaxRequest.always(ajaxCallbacks[onAlways]);
    }

}
var count = 0, 
    t = 2000,
    btn_remove = document.getElementById('btn-msg-toggle'),
    msgIcon = document.getElementById('toggle-board-menu'),
    board = document.getElementById('messages'),
    write = document.getElementById('write-textarea'),
    send = document.getElementById('write-board-send'),
    msg_collapsed = true,
    newMsg = false;

function setC(c){
    count = c;
}
function getC(){
    if(count === undefined){
        return 0;
    }
    return count;
}
function setNewMsg(n){
    newMsg = n;
}
function getNewMsg(){
    return newMsg;
}
function setMsgCollapsed(m){
    msg_collapsed = m;
}
function getMsgCollapsed(){
    return msg_collapsed;
}
function scrollPos()
{
    $("#message-content-panel").scroll(function(){
        return $("#message-content-panel").scrollTop() - $("#message-content-panel").offset().top;
    });
}
function scrollBottom(){
    $("#message-content-panel").scrollTop($("#message-content-panel")[0].scrollHeight);
}
function notify(){
    if(getNewMsg()){
        if(getMsgCollapsed()){
            msgIcon.className += 'animated pulse';
            msgIcon.style.cssText += 'background-color: #ee8366;';
        } else {
            if($('#write-textarea').is(':focus')){
                scrollBottom();
            }
            scrollBottom();
        }
    }
}
function resetNotify(){
    msgIcon.removeAttribute('class');
    msgIcon.removeAttribute('style');
    setNewMsg(false);

    if(!msg_collapsed){    
        $('#toggle-board-menu').hide();
    }
}
function clearWrite(){
    write.value = "";
}
function hideMsg(){
    $('#messages').hide();
    $('#toggle-board-menu').show();
}
function showMsg(){
    $('#messages').show();
    $('#toggle-board-menu').hide();
}
function fetch(){
    $('#fetch').click();
}
send.onclick = function(){
    setTimeout(function(){ clearWrite(); }, 1);
};
write.onclick = function(){
    if(getNewMsg){
        resetNotify();
    }
};
msgIcon.onclick = function(){
    if(msg_collapsed){
        showMsg();
        setMsgCollapsed(false);
        scrollBottom();
        if(getNewMsg()){
            resetNotify();
        }
    } else {
        hideMsg();
        setMsgCollapsed(true);
    }
};
btn_remove.onclick = function(){
    if(msg_collapsed){
        showMsg();
        setMsgCollapsed(false);
    } else {
        if(getNewMsg()){
            resetNotify();
        }
        hideMsg();
        setMsgCollapsed(true);
    }
};

document.getElementById("write-textarea").addEventListener("keydown", function(z) {
    //z.preventDefault();
    if (z.keyCode == 13 && !z.shiftKey){
        $('#write-board-send').click();
        fetch();
        scrollBottom();
    }
}, false);

var ajaxCallbacks = {
    'fetch': function (response) {
        //INITIALIZED
        if(getC() === 0){
            for(var i = 0; i < response.object.length; i++){
                //USER === POSTED_BY
                if(response.object[i].posted_by === response.id.uid){
                    if(response.data[i].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.foto.uimg + '" alt="' + response.data[i].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.data[i].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.foto.uimg + '" alt="' + response.data[i].value.username + '"/><p><small>' + response.data[i].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[i].value.username + '"/><p><small>' + response.data[i].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        }
                    }
                } else {//OTHER USERS
                    if(response.data[i].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[i].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.data[i].value.profile_image +'" alt="' + response.object[i].posted_by + '"/><p><small>' + response.data[i].value.username + '</small></p></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.object[i].posted_by + '"/><p><small>' + response.data[i].value.username + '</small></p></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[i].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.data[i].value.profile_image +'" alt="' + response.object[i].posted_by + '"/><p><small>' + response.data[i].value.username + '</small></p></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[i].value.username + '"/><p><small>' + response.data[i].value.username + '</small></p></li><li><pre>' + response.object[i].content + '</pre></li></ul></div><small class="other-separator"><hr><span id="timestamp">' + response.data[i].value.date + '<span></small>');
                        }
                    }
                }
            }
            setC(response.object.length);
            scrollBottom();
            console.log('after set: ' + getC());
        //UPDATE TIMESTAMP
        } else if(response.object.length === getC()){
            console.log('No changes: ' + getC());
            for(var nc = 0; nc < response.object.length; nc++){
                $('#b').find('small > span').eq(nc).html(response.data[nc].value.date);
            }
        //NEW MESSAGE
        } else if(response.object.length > getC()){
            console.log('elseif Fetching: ' + getC());
            setNewMsg(true);
            for(var j = getC(); j < response.object.length; j++){
                //USER === POSTED_BY
                if(response.object[j].posted_by === response.id.uid){
                    if(response.data[j].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.foto.uimg + '" alt="' + response.data[j].value.username + '"/><p><small>' + response.data[j].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.data[j].value.username + '"/><p><small>' + response.data[j].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.foto.uimg + '" alt="' + response.data[j].value.username + '"/><p><small>' + response.data[j].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[j].value.username + '"/><p><small>' + response.data[j].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        }
                    }
                } else {//OTHER USERS
                    if(response.data[j].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[j].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.data[j].value.profile_image +'" alt="' + response.object[j].posted_by + '"/><p><small>' + response.data[j].value.username + '</small></p></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.object[j].posted_by + '"/><p><small>' + response.data[j].value.username + '</small></p></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[j].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.data[j].value.profile_image +'" alt="' + response.object[j].posted_by + '"/><p><small>' + response.data[j].value.username + '</small></p></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[j].value.username + '"/><p><small>' + response.data[j].value.username + '</small></p></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="other-separator"><hr><span id="timestamp">' + response.data[j].value.date + '<span></small>');
                        }
                    }
                }
            }
            setC(response.object.length);
            notify();
            if($("#write-textarea").is(":focus") && getNewMsg()){
                scrollBottom();
            }
            console.log('new set: ' + getC());
        //DELETED MESSAGE
        } else if(response.object.length < getC()){
            $('#b').find('li').remove();
            $('#b').find('small').remove();
            console.log('else Fetching: ' + getC());
            for(var h = 0; h < response.object.length; h++){
                //USER === POSTED_BY
                if(response.object[h].posted_by === response.id.uid){
                    if(response.data[h].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.foto.uimg + '" alt="' + response.data[h].value.username + '"/><p><small>' + response.data[h].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.data[h].value.username + '"/><p><small>' + response.data[h].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.foto.uimg + '" alt="' + response.data[h].value.username + '"/><p><small>' + response.data[h].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[h].value.username + '"/><p><small>' + response.data[h].value.username + '</small></p></li></ul></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                } else {//OTHER USERS
                    if(response.data[h].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[h].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.data[h].value.profile_image +'" alt="' + response.object[h].posted_by + '"/><p><small>' + response.data[h].value.username + '</small></p></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.object[h].posted_by + '"/><p><small>' + response.data[h].value.username + '</small></p></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[h].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/users/' + response.data[h].value.profile_image +'" alt="' + response.object[h].posted_by + '"/><p><small>' + response.data[h].value.username + '</small></p></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[h].value.username + '"/><p><small>' + response.data[h].value.username + '</small></p></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                }
            }
            setC(response.object.length);
        }
    },
};

setTimeout(function(){
    $('#ui-load-message').hide();
}, 4000);

setInterval(function(){
    fetch();
}, t);