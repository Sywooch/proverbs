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

var $count;


function setC(c){
    $count = c;
}

function getC(){
    if($count === undefined){
        return 0;
    }
    return $count;
}

function notify(){
    $('#chat-icon').addClass('animated pulse notify-new-msg');
}

function resetNotify(){
    $('#chat-icon').removeClass('animated pulse notify-new-msg');
}
function clearWrite(){
    $('#write-textarea').val('');
}
var ajaxCallbacks = {

    'fetch': function (response) {
        if(getC() === 0){
            for(var i = 0; i < response.object.length; i++){
                //USER === POSTED_BY
                if(response.object[i].posted_by === response.id.uid){
                    if(response.data[i].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                        //if(response.data[i].profile_image !== undefined){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.foto.uimg + '" alt="' + response.data[i].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.data[i].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.foto.uimg + '" alt="' + response.data[i].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[i].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[i].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                } else {//OTHER USERS
                    if(response.data[i].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[i].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.data[i].value.profile_image +'" alt="' + response.object[i].posted_by + '"/><p><small></small></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.object[i].posted_by + '"/><p><small></small></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[i].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.data[i].value.profile_image +'" alt="' + response.object[i].posted_by + '"/><p><small></small></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[i].value.username + '"/><p><small></small></li><li><pre>' + response.object[i].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                }
            }
            //console.log('initial: ' + getC() + ' id:' + response.id.uid);
            setC(response.object.length);
            console.log('after set: ' + getC());

        } else if(response.object.length > getC()){
            console.log('elseif Fetching: ' + getC() + ' ako main');
            for(var j = getC(); j < response.object.length; j++){
                //USER === POSTED_BY
                if(response.object[j].posted_by === response.id.uid){
                    if(response.data[j].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                        //if(response.data[j].profile_image !== undefined){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.foto.uimg + '" alt="' + response.data[j].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.data[j].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.foto.uimg + '" alt="' + response.data[j].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[j].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[j].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                } else {//OTHER USERS
                    if(response.data[j].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[j].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.data[j].value.profile_image +'" alt="' + response.object[j].posted_by + '"/><p><small></small></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.object[j].posted_by + '"/><p><small></small></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[j].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.data[j].value.profile_image +'" alt="' + response.object[j].posted_by + '"/><p><small></small></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[j].value.username + '"/><p><small></small></li><li><pre>' + response.object[j].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                }
            }
            setC(response.object.length);
            console.log('new set: ' + getC());

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
                        //if(response.data[h].profile_image !== undefined){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.foto.uimg + '" alt="' + response.data[h].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.data[h].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.foto.uimg !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.foto.uimg + '" alt="' + response.data[h].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-self"><ul><li><pre>' + response.object[h].content + '</pre></li><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[h].value.username + '"/></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                } else {//OTHER USERS
                    if(response.data[h].value.gender === 0){//MALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[h].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.data[h].value.profile_image +'" alt="' + response.object[h].posted_by + '"/><p><small></small></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/male.png' + '" alt="' + response.object[h].posted_by + '"/><p><small></small></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    } else {//FEMALE
                        //USER HAS PROFILE IMAGE
                        if(response.data[h].value.profile_image !== (undefined || null)){
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/profile-img/' + response.data[h].value.profile_image +'" alt="' + response.object[h].posted_by + '"/><p><small></small></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        } else {//USER NO PROFILE IMAGE
                            $('#b').append('<div class="board-message-format-user"><ul><li><img class="message-profile-thumbnail" src="' + response.base.url + '/proverbs/uploads/user-thumb/female.png' + '" alt="' + response.data[h].value.username + '"/><p><small></small></li><li><pre>' + response.object[h].content + '</pre></li></ul><p><small></small></p></div><small class="separator"><hr><span id="timestamp"><span></small>');
                        }
                    }
                }
            }
            setC(response.object.length);
        }
    },

    'linkFormDone': function (response) {
        console.log(response.success);
        if(response.success){
            clearWrite();
        } else {

        }
    },

};
setInterval(function(){
    $('#ajax_link_01').click(); 
}, 3000);