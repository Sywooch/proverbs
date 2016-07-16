<?php
use app\models\Options;
use yii\helpers\Html;
$this->title = implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);
?>
<br>
<div class="ui two column stackable grid">
    <div class="four wide column">
        <div class="column">
            <?= $this->render('_card', ['model' => $model]) ?>
        </div>
    </div>
    <div class="nine wide column">
        <div class="column">
            <div id="student-info-menu">
                <div class="ui five item pointing menu stackable">
                    <a class="item active" data-tab="first">Student</a>
                    <a class="item" data-tab="second">Parents</a>
                    <a class="item" data-tab="third">Guardian</a>
                    <a class="item" data-tab="fourth">Previous School</a>
                    <a class="item" data-tab="fifth">Requirements</a>
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
