<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\DataHelper;
$avatar = DataHelper::avatar();
?>
<?php if($model->posted_by !== Yii::$app->user->identity->id) : ?>
	<div class="ui mini image">
		<img src="<?= !empty($model->postedBy->profile_image) ? implode('', [Yii::$app->request->baseUrl, '/uploads/users/',$model->postedBy->profile_image]) : $avatar ?>" style="background: #f7f7f7;">
	</div>
	<div class="bottom aligned content" style="margin: 0;">
		<div class="description bubble" style="margin-top: 0;">
			<span><?= Html::encode($model->content) ?></span>
		</div>
		<?php if(\Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffInDays() < 5 ): ?>
			<div class="meta" style="margin: 0;">
	            <div class="left aligned text">
	                <small><?= DataHelper::carbonDateDiff($model->created_at)?></small>
	            </div>
	        </div>		
		<?php endif ?>
	</div>
<?php else: ?>
	<div class="top aligned content" style="margin: 0;">
		<div class="description bubble self" style="margin-top: 0;">
			<span><?= Html::encode($model->content) ?></span>
		</div>
		<?php if(\Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffInDays() < 5 ): ?>
			<div class="meta" style="margin: 0;">
	            <div class="left aligned text">
	                <small><?= DataHelper::carbonDateDiff($model->created_at)?></small>
	            </div>
	        </div>		
		<?php endif ?>
	</div>
	<div class="ui mini image">
		<img src="<?= !empty($model->postedBy->profile_image) ? implode('', [Yii::$app->request->baseUrl, '/uploads/users/',$model->postedBy->profile_image]) : $avatar ?>" style="background: #f7f7f7;">
	</div>
<?php endif ?>
<?php
$hvr = <<< JS
$(document).ready(function(){
	$('#bm > .item').hover(function(){
		//username	$(this.lastElementChild.firstElementChild.innerText).selector
		//content 	$(this.lastElementChild.firstElementChild.nextElementSibling.innerText).selector
		//date 		$(this.lastElementChild.firstElementChild.nextElementSibling.nextElementSibling.innerText).selector
		if($('body').hasClass('sidebar-narrow')){
			console.log( $(this.lastElementChild.firstElementChild.nextElementSibling.nextElementSibling.innerText).selector );
		}
	});
});
JS;
$this->registerJs($hvr);
?>