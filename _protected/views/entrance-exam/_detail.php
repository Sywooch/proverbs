<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty(trim($model->applicant['middle_name'])) ? $middle = ucfirst(substr($model->applicant['middle_name'], 0,1)).'.' : $middle = '';
$this->title = implode(' ', [$model->applicant['first_name'], $middle, $model->applicant['last_name']]);
?>
<?php Pjax::begin(['id' => 'entrance-exam-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
    <div class="ui inverted dimmer">
        <div class="ui massive text loader"></div>
    </div>
	<?= UiTable::widget([
    'model' => $model,
    'options' => ['class' => 'ui fixed very basic table'],
    'attributes' => [
    		'applicant_id',
    		'english',
    		'reading_skills',
    		'science',
    		'comprehension',
            [
                'attribute' => 'remarks',
                'value' => $model->getRemarks($model->remarks)
            ],
    		[
                'attribute' => 'recommendations',
                'value' => $model->getRecommendations($model->recommendations)
            ],
            'created_at:date',
    		'updated_at:date',
    	]
    ])
    ?>
</div>
<?php Pjax::end() ?>