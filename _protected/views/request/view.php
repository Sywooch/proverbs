<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use app\models\Options;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'profile-detail', 'timeout' => 60000]); ?>
<div class="ui two column stackable grid">
    <div class="thirteen wide column">
        <div class="ui segment">
            <div class="column">
                <div class="ui inverted dimmer">
                    <div class="ui massive text loader"></div>
                </div>
                <?= UiTable::widget([
            		'model' => $model,
            		'options' => ['class' => 'ui fixed very basic table'],
            		'attributes' => [
            			'id',
                        'request_text',
                        [
                            'attribute' => 'user_id',
                            'value' => $model->getUsername($model->user_id)
                        ],
                        [
                            'attribute' => 'student_id',
                            'value' => $model->getStudentDetails($model->student_id)
                        ],
            			'created_at:date',
            			'updated_at:date',
            		],
            	]); ?>
            </div>
        </div>
    </div>
    <div class="three wide column">
        <div class="column">
            <?= Options::render(['scenario' => Yii::$app->controller->action->id, 'id' => $model->id]); ?>
        </div>
    </div>
<?php Pjax::end(); ?>
</div>
<?= $this->render('/layouts/_toast')?>
