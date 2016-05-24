<?php 
use yii\helpers\Html;
use app\models\DataCenter;
?>
<div class="ui fluid vertical menu">
    <div class="item">
        <div class="header"><span><i class="ui big icon options"></i></span></div>
    </div>
    <div class="item">
    	<h5>Request Data Access</h5>
		<p><input id="req_form" type="text" name="student_id" placeholder="Student ID#" class="form-control pva-form-control"></p>
		<p>
			<?php if(DataCenter::dataAccessRequest() === 0) : ?>
				<?= Html::button('Send Request',['id' => 'req_access', 'class' => 'ui fluid big positive button'])?>
			<?php else :?>
				<?= Html::button('<i class="lock icon"></i>&nbsp; Send Request',['class' => 'ui fluid big disabled button']) ?>
			<?php endif ?>
		</p>
    </div>
    <div class="item">
    	<?php  ?>
    </div>
</div>
<?php 
$request_url = json_encode(Yii::$app->request->baseUrl . '/site/request-access?data=');
$request = <<< JS
(function($){
	$(window).load(function(){
		var req_form = $('#req_form');
		var req_btn = $('#req_access');

		function sendRequest(){
			$.ajax({
                type: 'POST',
                url: $request_url + JSON.stringify({
                        sid: req_form.val(),
                    }),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
	            success: function(data){
	            	changeState();
		        	if(data.sent){
		        		req_btn.html('<i class="checkmark icon"></i>&nbsp; Sent');
		        		req_btn.addClass('disabled');
		            	setTimeout(function(){
		        			req_btn.removeClass('disabled');
		            		req_btn.html('Send Request');
		            		req_form.val('');
		            	},2500);
		        	}	            	
					console.log(data);
	            },
            });
		}

		function changeState(data){
			if($(req_btn).hasClass('loading')){
				req_btn.removeClass('loading');
			}else {
				req_btn.addClass('loading');
			}
		}

		req_btn.click(function(){
			if(req_form.val() !== ''){
				changeState();
				sendRequest();
				console.log('sending...');
			}
		});
	});
})(jQuery);
JS;
$this->registerJs($request);
?>