<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->enrolled->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->enrolled->student->students_profile_image : $img = $avatar;
!empty(trim($model->enrolled->student->middle_name)) ? $middle = ucfirst(substr($model->enrolled->student->middle_name, 0,1)).'.' : $middle = '';
?>

<?php Pjax::begin(['id' => 'assessment-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
        <div class="image">
            <?php if(!empty($model->enrolled->student->students_profile_image)) : ?>
                <?= Html::img(['/file','id'=>$model->enrolled->student->students_profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $model->enrolled->student->id ?></strong></label>
			<div class="header">
				<?= Html::a(implode(' ', [$model->enrolled->student->first_name, $middle, $model->enrolled->student->last_name]),['/students/view', 'id' => $model->enrolled->student->id]) ?>
			</div>
		    <div class="meta"><span id="meta-content"><?= implode('', ['\'', $model->enrolled->student->nickname, '\'']) ?></span></div>
		</div>
		<div class="extra content">
			<label class="left floated student-id"><span><?= $model->enrolled->student->gradeLevel->name ?></span></label>
			<span class="right floated">
				<?php if($model->enrolled->student->sped === 0) : ?><div class="ui star rating sped" data-rating="1"><div class="icon active" style="font-size:  16px;"></div></div><?php endif ?>
			</span>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>