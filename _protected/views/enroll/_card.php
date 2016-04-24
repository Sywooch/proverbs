<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar;
!empty(trim($model->student->middle_name)) ? $middle = ucfirst(substr($model->student->middle_name, 0,1)).'.' : $middle = '';
?>

<?php Pjax::begin(['id' => 'enroll-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image"><img src="<?= $img ?>" class="tiny image"></div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $model->student_id ?></strong></label>
			<div class="header">
				<?= Html::a(implode(' ', [$model->student->first_name, $middle, $model->student->last_name]),['/students/view', 'id' => $model->student->id]) ?>
			</div>
		    <div class="meta"><span id="meta-content"><?= implode('', ['\'', $model->student->nickname, '\'']) ?></span></div>
		</div>
		<div class="extra content">
			<label class="left floated student-id"><span><?= $model->levelName ?></span></label>
			<span class="right floated">
				<?php if($model->student->sped === 0) : ?><div class="ui star rating sped" data-rating="1"><div class="icon active" style="font-size:  16px;"></div></div><?php endif ?>
			</span>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>