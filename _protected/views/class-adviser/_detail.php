<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use app\models\DataHelper;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'class-adviser-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= Html::a('View Profile',['/profile/view', 'id' => $profile['id']],['class' => 'ui right floated huge basic button'])?>
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    	[
	    		'attribute' => 'sy_id',
	    		'value' => DataHelper::schoolYear($model->sy_id)
	    	],
	    	[
	    		'attribute' => 'teacher_id',
	    		'value' => DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name)
	    	],
	    	[
	    		'attribute' => 'grade_level_id',
	    		'value' => $model->gradeLevel->name
	    	],
	    	'section.section_name'
    	]
	])?>
</div>
<?php Pjax::end(); ?>