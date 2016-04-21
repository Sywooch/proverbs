<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty(trim($model->applicant['middle_name'])) ? $middle = ucfirst(substr($model->applicant['middle_name'], 0,1)).'.' : $middle = '';
$this->title = implode(' ', [$model->applicant['first_name'], $middle, $model->applicant['last_name']]);
?>
<?php Pjax::begin(['id' => 'entrance-exam-detail', 'timeout' => 10000, 'enablePushState' => false]); ?>
<div class="ui segment">
	<?= UiTable::widget([
    'model' => $model,
    'options' => ['class' => 'ui fixed very basic table'],
    'attributes' => [
    		'id',
    		'applicant_id',
    		'english',
    		'reading_skills',
    		'science',
    		'comprehension',
    		'remarks',
    		'recommendations',
    		'created_at:date',
    		[
    			'attribute' => 'updated_at',
    			'value' => $model->getUpdatedAt($model->updated_at)
    		]
    	]
    ])
    ?>
</div>
<?php Pjax::end() ?>
<?= $this->render('_pjax') ?>