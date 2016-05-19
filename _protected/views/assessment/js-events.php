<?php
if(!$model->isNewRecord){
	$sbv = json_encode($model->sibling_discount);
	$hnv = json_encode($model->honor_discount);
	$bkv = json_encode($model->book_discount);
	$ttlv = json_encode($model->total_assessed);
	$balv = json_encode($model->balance);
}

$events = <<< JS
$(document).ready(function(){
	var calcBtn = $('#calc');
	var pv = $('#pv');
	var zero = 0;
	var sw1 = $('#assessmentform-has_sibling_discount');
	var sw2 = $('#assessmentform-has_honor_discount');
	var sw3 = $('#assessmentform-has_book_discount');
	var form1 = $('#assessmentform-sibling_discount');
	var form2 = $('#assessmentform-honor_discount');
	var form3 = $('#assessmentform-book_discount');
	var perc = $('#assessmentform-percentage_value');
	var field1 = $('#f1');
	var field2 = $('#f2');
	var field3 = $('#f3');
	var total = $('#assessmentform-total_assessed');
	var bal = $('#assessmentform-balance');
	var td_sbv = $('#td-sibling-discount');
	var td_hnv = $('#td-honor-discount');
	var td_bkv = $('#td-book-discount');
	var td_ttl = $('#td-total-assessed');

	//TUITION
	var enrollment = $enrollment;
	var admission = $admission;
	var tuition_fee = $tuition_fee;
	var misc_fee = $misc_fee;
	var ancillary = $ancillary;
	var yearly = $yearly;
	var monthly = $monthly;
	var books = $books;

	var sbd = $sbd;
	var hnd = $hnd;
	var bkd = $bkd;
	var sbv = $sbv;
	var hnv = $hnv;
	var bkv = $bkv;
	var ttlv = $ttlv;
	var balv = $balv;
	
	$('input').blur(function(){
		calcBtn.click();
	});

	function getPercentage(){
		return $('#assessmentform-percentage_value option:selected').val();
	}

	function d1(){
		form1.val(zero.toFixed(2));
    	field1.addClass('disabled');
	}

	function d2(){
		form2.val(zero.toFixed(2));
    	field2.addClass('disabled');
	}

	function d3(){
		form3.val(zero.toFixed(2));
    	field3.addClass('disabled');
	}

	function d4(){
		$(perc).val($('#assessmentform-percentage_value option:first').val());
		$(perc).attr('disabled', 'true');
	}

	function e1(){
    	field1.removeClass('disabled');
	}

	function e2(){
    	field2.removeClass('disabled');
	}

	function e3(){
    	field3.removeClass('disabled');
	}

	function e4(){
		$(perc).removeAttr('disabled');
	}

    function syncValue(elem){
        if(elem.defaultValue !== elem.previousElementSibling.defaultValue){
            elem.previousElementSibling.defaultValue = elem.defaultValue;
        }

        if(parseInt(sw1.val()) === 1){
			$(perc).attr('disabled', 'true');
        }

        pv.html(getPercentage());
		form1.val(($sbv).toFixed(2));
		form2.val(($hnv).toFixed(2));
		form3.val(($bkv).toFixed(2));
		total.val(($ttlv).toFixed(2));
		bal.val(($balv).toFixed(2));
    }

    function changeState(elem){
        if(parseInt(elem.defaultValue) === 1){
    		//calcBtn.click();
            elem.checked = false;
            $(elem).attr('checked', false);
            elem.previousElementSibling.defaultValue = 1;
        } else {
    		//calcBtn.click();
            elem.checked = true;
            $(elem).attr('checked', true);
            elem.previousElementSibling.defaultValue = 0;
        }
    }

	perc.change(function(){
		pv.html($(this).val());
		calc();
	});

	function subCalc(){
		console.log('subcalc');
		td_sbv.html('<strong>' + form1.val() + '</strong>');
		td_hnv.html('<strong>' + form2.val() + '</strong>');
		td_bkv.html('<strong>' + form3.val() + '</strong>');
	}

	function calc(){
		var subtotal = parseFloat($subtotal);
		var sibling_discount = tuition_fee * (parseInt(getPercentage())/100);
		form1.val(sibling_discount.toFixed(2));

		result = (subtotal + books) - parseFloat(sibling_discount) - parseFloat(form2.val()) - parseFloat(form3.val());

		td_ttl.html('<strong>' + result.toFixed(2) + '</strong>');
		total.val(result.toFixed(2));
	}
	
	calcBtn.click(function(){
		subCalc();
		calc();
	});
	
    if (Array.prototype.forEach) {
        var i = 0;
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        
        elems.forEach(function(html) {
        	syncValue(elems[i]);
            changeState(elems[i]);
        	var switchery = new Switchery(html, {size: 'small', speed: '0.2s'});
            
            elems[i].onchange = function() { 
				

                if(this.checked){
                    this.defaultValue = 0;
					changeState(this);

                    if($(this).attr('id') === $(sw1).attr('id')){
                    	e1();
                    	e4();
                    	pv.html(getPercentage());
                    	calcBtn.click();
                    }else if($(this).attr('id') === $(sw2).attr('id')){
                    	e2();
                    	calcBtn.click();
                    }else {
                    	e3();
                    	calcBtn.click();
                    }

                } else {
                    this.defaultValue = 1;
					changeState(this);

                    if($(this).attr('id') === $(sw1).attr('id')){
                    	d1();
                    	d4();
                    	pv.html(getPercentage());
                    	calcBtn.click();
                    }else if($(this).attr('id') === $(sw2).attr('id')){
                    	d2();
                    	calcBtn.click();
                    }else {
                    	d3();
                    	calcBtn.click();
                    }
                }
            };
            i++;
        });
    } else {
        var i = 0;
        var elems = document.querySelectorAll('.js-switch');

        for (i ; i < elems.length; i++) {
            elems[i].onchange = function() { 

                if(this.checked){
                    this.defaultValue = 0;
					changeState(this);

                    if($(this).attr('id') === $(sw1).attr('id')){
                    	e1();
                    	e4();
                    	pv.html(getPercentage());
                    	calcBtn.click();
                    }else if($(this).attr('id') === $(sw2).attr('id')){
                    	e2();
                    	calcBtn.click();
                    }else {
                    	e3();
                    	calcBtn.click();
                    }
                } else {
                    this.defaultValue = 1;
					changeState(this);

                    if($(this).attr('id') === $(sw1).attr('id')){
                    	d1();
                    	d4();
                    	pv.html(getPercentage());
                    	calcBtn.click();
                    }else if($(this).attr('id') === $(sw2).attr('id')){
                    	d2();
                    	calcBtn.click();
                    }else {
                    	d3();
                    	calcBtn.click();
                    }
                }
            };
        }
    }
});
JS;
$this->registerJs($events);
?>