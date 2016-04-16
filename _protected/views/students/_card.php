<?php
use yii\helpers\Html;
$def = Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png';
!empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $def;
$model->gender === 0 ? $gender = 'Male <i class="man icon"></i>' : $gender = 'Female <i class="woman icon"></i>';
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image"><img src="<?= $img ?>" class="tiny image"></div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $model->id ?></strong></label>
			<div class="header">
				<?= Html::a(implode(' ', [$model->first_name, $middle, $model->last_name]),['view?id=' . $model->id], ['class' => '']) ?>
			</div>
		    <div class="meta">	
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