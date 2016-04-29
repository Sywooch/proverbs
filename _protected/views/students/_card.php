<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'student-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image"><img src="<?= $img ?>" class="tiny image"></div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $model->id ?></strong></label>
			<div class="header">
				<?= DataHelper::name($model->first_name, $model->middle_name, $model->last_name) ?>
				<p></p>
			</div>
		    <div class="meta">
				<span id="meta-content"><?= implode('', ['\'', $model->nickname, '\'']) ?></span>
				<p></p>
		    </div>
		</div>
		<div class="extra content">
			<label class="left floated student-id"><span><?= $model->gradeLevel->name ?></span></label>
			<span class="right floated">
				<?php if($model->sped === 0) : ?><div class="ui star rating sped" data-rating="1"><div class="icon active" style="font-size:  16px;"></div></div><?php endif ?>
			</span>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>