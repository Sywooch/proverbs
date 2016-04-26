<?php
use app\models\Options;
use app\models\DataHelpers;
use yii\helpers\Html;

$this->title = implode(' ', [$model->enrolled->student->first_name, $model->enrolled->student->middle_name, $model->enrolled->student->last_name]);
?>
<p></p>
<div class="ui two column stackable grid">  
    <div class="four wide column">
        <div class="column">
            <?= $this->render('_card', ['model' => $model]) ?>
        </div>
    </div>
    <div class="nine wide column">
        <div class="column">
            <div id="assessment-info-menu">
                <div class="ui three item pointing menu stackable">
                    <a class="item active" data-tab="first">Assessment</a>
                    <a class="item" data-tab="second">Tuition</a>
                    <a class="item" data-tab="third">Calculation</a>
                </div>
                <?= $this->render('_detail', ['model' => $model]) ?>
            </div>
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