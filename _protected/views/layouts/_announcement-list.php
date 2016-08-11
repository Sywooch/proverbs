<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\DataHelper;
$avatar = DataHelper::avatar();
?>
<div class="ui top aligned content">
	<div class="right floated">
		<!-- <input data-key="<?php // $model->id?>" type="checkbox" name="announcement-key"> -->
	</div>
	<div class="description" style="margin-top: -2px;">
		<p><?= Html::encode($model->content) ?></p>
	</div>
	<div class="date date-announcement">
		<span><strong><?= $model->postedBy->username?></strong></span>&nbsp;&nbsp;
		<?php if(\Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffInMinutes() <  60): ?>
			<small><?= DataHelper::carbonDateDiff($model->created_at)?></small>
		<?php else: ?>
			<?= DataHelper::carbonDateTime($model->created_at)  ?>
		<?php endif ?>
	</div>
</div>
