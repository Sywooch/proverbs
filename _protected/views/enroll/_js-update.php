<?php
    $sid = json_encode($student->id);
    $this->registerJs("
	    var ssid = $('#enroll-profile-id');
	    var sname = $('#enroll-profile-name');
	    var snick = $('#enroll-profile-nickname');
	    var saddr = $('#enroll-profile-address');
	    var sbirth = $('#enroll-profile-birth');
	    var sage = $('#enroll-profile-age');
    	var simg = $('#enroll-student-profile-image');
        var ssped = $('#enroll-profile-sped');

        $.ajax({
            type: 'POST',
            url: 'card?data=' + JSON.stringify({
                    sid: $sid
                }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                sname.html('<a href=\" ../students/view?id=' + data.sid + '\">' + data.name + '</a>');
                snick.html(data.nick);
                ssid.html('ID#: ' + '<strong>' + data.sid + '</strong>');
                saddr.html(data.addr);
                sbirth.html(data.bday);
		        
		        if(data.age === 0 || data.age === 1) {
		            $('#enroll-profile-age').html(data.age + ' year old');
		        } else {
		            $('#enroll-profile-age').html(data.age + ' years old');
		        }

                
		        if(data.img === 'empty'){
		        	simg.attr('src', '../uploads/ui/user-blue.png');
					simg.addClass('grow').removeClass('fastShrink').removeClass('hidden');
		        } else {
		        	simg.attr('src', data.img);
					simg.addClass('grow').removeClass('fastShrink').removeClass('hidden');
		        }

                if(data.spd === 0) {
                    ssped.removeClass('hidden');
                } else {
                    ssped.addClass('hidden');
                }
            }
        });
    ");  
?>