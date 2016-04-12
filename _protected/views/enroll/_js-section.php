<?php
$this->registerJs("
var g = $('#enrolledform-section_id');

$(window).load(function(){
    $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#enrolledform-grade_level_id').val()), function(data){
	    $('#enrolledform-section_id').find('option').remove();
	    $('#enrolledform-section_id').each(function(){
	        $(this).append(data);
	    });
	});
});
");
?>