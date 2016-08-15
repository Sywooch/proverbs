<?php
use app\models\Options;
use yii\helpers\Html;
use app\models\AssessmentForm;
use app\models\PaymentForm;

$this->title = implode(' ', [$model->student->first_name, $model->student->middle_name, $model->student->last_name]);
$payments = PaymentForm::find()->where(['assessment_id' => $assessment[0]->id])->orderBy(['id' => SORT_DESC])->all()
?>
<div class="ui two column stackable grid">
    <div class="four wide column">
        <div class="column">
            <?= $this->render('_card', ['model' => $model]) ?>
        </div>
    </div>
    <div class="nine wide column">
        <div class="column">
            <?= $this->render('_detail', ['model' => $model, 'assessment' => $assessment[0], 'payments' => $payments]) ?>
        </div>
    </div>
    <div class="three wide column">
        <div class="column">
            <?= Options::render(['scenario' => Yii::$app->controller->action->id, 'id' => $model->id]); ?>
        </div>
    </div>
</div>
<?= $this->render('_pjax', ['model' => $model]) ?>
<?= $this->render('/layouts/_toast')?>
