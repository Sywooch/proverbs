<?php
use yii\helpers\Html;
$this->title = implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);
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
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::a(Yii::t('app', 'New'),['create'], ['class' => 'ui link fluid huge primary button']) ?>
                    <p></p>
                    <?= Html::a(Yii::t('app', 'Edit'),['update', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                    <p></p>
                    <?= Html::a(Yii::t('app', 'Delete'),['delete', 'id' => $model->id], ['title'=>'Delete Studnet', 'class' => 'ui link fluid huge grey button', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this applicant?'),'method' => 'post']]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('_pjax', ['model' => $model]) ?>