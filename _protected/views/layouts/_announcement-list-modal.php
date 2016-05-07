<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\DataHelper;
$avatar = DataHelper::avatar();
?>
<div class="ui top aligned content">
	<div class="right floated">
		<a id="<?= $model->id ?>" class="anc-delete"><i class="remove icon" style="color: #767676;"></i></a>
	</div>
	<div class="description" style="margin-top: -2px;">
		<?= Html::encode($model->content) ?>
	</div>
	<?php if(\Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffInDays() < 5 ): ?>
		<div class="meta">
			<div class="left aligned text"><small><?= DataHelper::carbonDateDiff($model->created_at)?></small></div>
		</div>
	<?php endif ?>
</div>