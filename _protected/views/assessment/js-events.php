<?php
$enrollment = json_encode($model->tuition->enrollment);
$admission = json_encode($model->tuition->admission);
$tuition_fee = json_encode($model->tuition->tuition_fee);
$misc_fee = json_encode($model->tuition->misc_fee);
$ancillary = json_encode($model->tuition->ancillary);
$yearly = json_encode($model->tuition->yearly);
$monthly = json_encode($model->tuition->monthly);
$books = json_encode($model->tuition->books);

if($model->isNewRecord){
	//$sbd = json_encode();
	//$hnd = json_encode();
	//$bkd = json_encode();
}else {
	$sbd = json_encode($model->sibling_discount);
	$hnd = json_encode($model->honor_discount);
	$bkd = json_encode($model->book_discount);
}

$events = <<< JS
$(document).ready(function(){
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
	
	function d1(){
		form1.val(0);
    	field1.addClass('disabled');
	}

	function d2(){
		form2.val(0);
    	field2.addClass('disabled');
	}

	function d3(){
		form3.val(0);
    	field3.addClass('disabled');
	}

	function d4(){
		$(perc).val($('#assessmentform-percentage_value option:first').val());
		$(perc).attr('disabled', 'true');
	}

	function e1(){
		form1.val(1);
    	field1.removeClass('disabled');
	}

	function e2(){
		form2.val(1);
    	field2.removeClass('disabled');
	}

	function e3(){
		form3.val(1);
    	field3.removeClass('disabled');
	}

	function e4(){
		$(perc).removeAttr('disabled');
	}

    if (Array.prototype.forEach) {
        var i = 0;
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        
        elems.forEach(function(html) {
            elems[i].onchange = function() { 
                if(this.checked){
                    this.defaultValue = 0;

                    if($(this).attr('id') === $(sw1).attr('id')){
                    	e1();
                    	e4();
                    }else if($(this).attr('id') === $(sw2).attr('id')){
                    	e2();
                    }else {
                    	e3();
                    }

                } else {
                    this.defaultValue = 1;

                    if($(this).attr('id') === $(sw1).attr('id')){
                    	d1();
                    	d4();
                    }else if($(this).attr('id') === $(sw2).attr('id')){
                    	d2();
                    }else {
                    	d3();
                    }
                }
            };
            i++;
        });

        function calc(){
			
        }

    } else {
        var i = 0;
        var elems = document.querySelectorAll('.js-switch');

        for (i ; i < elems.length; i++) {
            elems[i].onchange = function() { 
                if(this.checked){
                    this.defaultValue = 0;
                }else {
                    this.defaultValue = 1;
                }
            };
        }
    }
});
JS;
$this->registerJs($events);
?>