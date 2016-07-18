<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
?>
<?php Pjax::begin(['id' => 'student-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
        <div class="image">
            <?php if(!empty($models[0]->enrolled->student->students_profile_image)) : ?>
                <?= Html::img(['/file','id'=>$models[0]->enrolled->student->students_profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $models[0]->enrolled->student->id ?></strong></label>
			<div class="header">
				<?= DataHelper::name($models[0]->enrolled->student->first_name, $models[0]->enrolled->student->middle_name, $models[0]->enrolled->student->last_name) ?>
				<p></p>
			</div>
		    <div class="meta">
				<span id="meta-content"><?= implode('', ['\'', $models[0]->enrolled->student->nickname, '\'']) ?></span>
				<p></p>
		    </div>
		</div>
		<div class="extra content">
			<label class="left floated student-id"><span><?= $models[0]->enrolled->student->gradeLevel->name ?></span></label>
			<span class="right floated">
				<?php if($models[0]->enrolled->student->sped === 0) : ?>
					<div class="ui star rating sped" data-rating="1">
						<div class="icon active" style="font-size:  16px;"></div>
					</div>
				<?php endif ?>
			</span>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>
