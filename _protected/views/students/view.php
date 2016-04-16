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
                <?= Html::a('New<i class="right floated icon plus"></i>',['create'], ['class' => 'ui link item right labeled icon', 'style' => 'color: #4a8bc2;']) ?>
                <?= Html::a('Edit<i class="right floated icon edit"></i>',['update', 'id' => $model->id], ['class' => 'ui link item right labeled icon', 'style' => 'color: #4a8bc2;']) ?>
                <?= Html::a('Delete<i class="right floated icon trash"></i>',['delete', 'id' => $model->id], ['title'=>'Delete Student', 'class' => 'ui link item right labeled icon', 'style' => 'color: #4a8bc2;', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this student?'),'method' => 'post']]) ?>
            </div>
        </div>
    </div>
</div>