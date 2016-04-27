<?php
use app\models\Options;
use yii\helpers\Html;
use app\models\ProfileForm;
$profile = ProfileForm::find()->where(['id' => $model->teacher->id])->one();

$this->title = implode(' ', [$model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name]);
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
            <?= $this->render('_detail', ['model' => $model, 'profile' => $profile]) ?>
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