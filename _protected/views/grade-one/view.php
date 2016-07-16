<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Options;
/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */

?>
<div class="ui three column stackable grid">
    <div class="four wide column">
        <div class="column">
            <?= $this->render('_card', ['model' => $model]) ?>
        </div>
    </div>
    <div class="nine wide column">
        <div class="column">
            <?= $this->render('_detail', ['model' => $model]) ?>
        </div>
    </div>
    <div class="three wide column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Edit'),['update', 'eid' => $eid, 'grading' => $grading], ['class' => 'ui link fluid huge teal button']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/students'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
