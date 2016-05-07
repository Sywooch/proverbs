<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\DataHelper;
$avatar = DataHelper::avatar();
?>
<div class="ui mini image">
	<img src="<?= !empty($model->postedBy->profile_image) ? implode('', [Yii::$app->request->baseUrl, '/uploads/users/',$model->postedBy->profile_image]) : $avatar ?>" style="background: #f7f7f7;">
</div>
<div class="ui top aligned content">
	<div class="description" style="margin-top: -2px;">
		<?= Html::encode($model->content) ?>
	</div>
	<?php if(\Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffInDays() < 5 ): ?>
		<div class="meta">
			<div class="left aligned text"><small><?= DataHelper::carbonDateDiff($model->created_at)?></small></div>
		</div>
	<?php endif ?>
</div>
