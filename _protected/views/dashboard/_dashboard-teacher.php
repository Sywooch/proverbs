<?php
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;
$this->title = 'Dashboard';
?>
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<h1>Welcome <?= ucfirst(Yii::$app->user->identity->username) ?></h1>
				<?= time()?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
			</div>
		</div>
	</div>
</div>
<?php
$t = <<< JS
$(document).ready(function(){
	//$('#chat-icon').addClass('animated pulse notify-new-msg');
	//$('#ajax_result_02').html('check');
});
JS;
$this->registerJs($t);
?>