<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\DataHelper;
$avatar = DataHelper::avatar();
?>
<div class="ui mini avatar image">
	<img src="<?= !empty($model->postedBy->profile_image) ? 
		Url::to(['/file', 'id' => $model->postedBy->profile_image]) : $avatar ?>" style="background: #f7f7f7;">
</div>
<div class="bottom aligned content" style="margin: 0;">
	<div class="description" style="margin-top: 0;">
		<div class="bubble <?= $model->posted_by !== Yii::$app->user->identity->id ? '' : 'self'?>">
			<p><?= $model->content ?></p>
		</div>
	</div>
	<?php if(\Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffInHours() < 1 ): ?>
		<div class="meta" style="margin: 0;">
            <div class="left aligned text">
                <small><?= DataHelper::carbonDateDiff($model->created_at)?></small>
            </div>
        </div>		
	<?php endif ?>
</div>