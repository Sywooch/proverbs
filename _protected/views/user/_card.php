<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\rbac\models\AuthAssignment;
use app\models\DataHelper;
?>
<?php Pjax::begin(['id' => 'user-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image">
            <?php if(!empty($model->profile_image)) : ?>
                <?= Html::img(['/file','id'=>$model->profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
		</div>
		<div class="ui center aligned content">
			<label><em><?= $model->email ?></em></label>
			<div class="header">
				<?= Html::a(DataHelper::name($model->first_name, $model->middle_name, $model->last_name), '#', ['']) ?>
			</div>
			<div class="meta"><span id="meta-content"><?= implode('', ['\'', $model->username, '\'']) ?></span></div>
		</div>
		<div class="extra center aligned content">
			<label class="user-id"><span><?= ucfirst($model->role->item_name) ?></span></label>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>