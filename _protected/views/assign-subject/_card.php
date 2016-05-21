<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;
?>

<?php Pjax::begin(['id' => 'assign-subject-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
        <div class="image">
            <?php if(!empty($model->teacher->profile_image)) : ?>
                <?= Html::img(['/file','id'=>$model->teacher->profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
		<div class="ui center aligned content">
			<label><em><?= $model->teacher->email ?></em></label>
			<div class="header">
				<?= Html::a(DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name),['profile/view', 'id' => $model->teacher->id],['class' => '']) ?>
			</div>
		    <div class="meta"><span id="meta-content"><?= implode('', ['\'', $model->teacher->username, '\'']) ?></span></div>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>