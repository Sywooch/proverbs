<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
?>
<?php Pjax::begin(['id' => 'grade-one-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
    <?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
        'attributes' => [
            'id',
            'enrolled_id',
            'grade_protection',
            'subject_1',
            'subject_2',
            'subject_3',
            'subject_4',
            'subject_5',
            'subject_6',
            'subject_7',
            'subject_8',
            'core_value_1',
            'core_value_2',
            'core_value_3',
            'core_value_4',
        ],
    ])?>
    <?php Pjax::end(); ?>
</div>
