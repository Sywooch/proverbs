<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'student-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
        <div class="image">
            <?php if(!empty($model->student->students_profile_image)) : ?>
                <?= Html::img(['/file','id'=>$model->student->students_profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $model->student->id ?></strong></label>
			<div class="header">
				<?= Html::a(DataHelper::name($model->student->first_name, $model->student->middle_name, $model->student->last_name),['/students', 'id' => $model->student->id],[]) ?>
				<p></p>
			</div>
		    <div class="meta">
				<span id="meta-content"><?= implode('', ['\'', $model->student->nickname, '\'']) ?></span>
				<p></p>
		    </div>
		</div>
		<div class="extra content">
			<label class="left floated student-id"><span><?= $model->student->gradeLevel->name ?></span></label>
			<span class="right floated">
				<?php if($model->student->sped === 0) : ?><div class="ui star rating sped" data-rating="1"><div class="icon active" style="font-size:  16px;"></div></div><?php endif ?>
			</span>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>