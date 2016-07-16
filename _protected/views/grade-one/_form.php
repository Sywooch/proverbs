<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Card;
use app\models\Options;
use app\models\DataHelper;

/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
    <div class="ui three column stackable grid">
        <div class="four wide rounded column">
            <?= Card::render($options = [
                'imageContent' => !$model->isNewRecord ?
                    !empty($enrolled->student->students_profile_image) ? ['/file', 'id' => $enrolled->student->students_profile_image] : implode('',[Yii::$app->request->baseUrl, Yii::$app->params['avatar']])
                            : implode('',[Yii::$app->request->baseUrl, Yii::$app->params['avatar']]),
                'labelContent' => implode(' ', ['ID#', '<strong>', $enrolled->student->id, '</strong>']),
                'labelFor' => 'Applicant ID',
                'labelOptions' => '',
                'headerContent' => DataHelper::name($enrolled->student->first_name, $enrolled->student->middle_name, $enrolled->student->last_name),
                'headerOptions' => '',
                'metaContent' => implode('', ['\'', $enrolled->student->nickname, '\'']),
                'metaOptions' => '',
                'leftFloatedContent' => DataHelper::gradeLevel($enrolled->student->grade_level_id),
                'leftFloatedFor' => '',
                'leftFloatedOptions' => '',
                'rightFloatedContent' => '',
                'rightFloatedOptions' => $enrolled->student->sped === 0 ? '' : 'hidden'
            ]) ?>
        </div>
        <div class="nine wide rounded column">
            <div class="ui segment">
                <?php if($exist): ?>
                    <label for="exist">Record already exist!</label>
                <?php else: ?>
                    <?= $this->render('_table'); ?>
                <?php endif ?>
            </div>
        </div>
        <div class="three wide rounded column">
            <div class="column">
                <?php if($exist): ?>
                    <?= Options::render(['scenario' => Yii::$app->controller->action->id, 'exist' => $exist]); ?>
                <?php else: ?>
                    <?= Options::render(['scenario' => Yii::$app->controller->action->id, 'exist' => $exist]); ?>
                <?php endif ?>
            </div>
        </div>

    </div>
<?php ActiveForm::end(); ?>
<?php $this->render('switch'); ?>
<?= $this->render('/layouts/_toast', ['model' => $model])?>
