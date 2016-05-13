<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;
?>
<?php Pjax::begin(['id' => 'entrance-exam-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
    <div class="card">
        <div class="image">
            <?php if(!empty($model->applicant['students_profile_image'])) : ?>
                <?= Html::img(['/file','id'=>$model->applicant['students_profile_image']]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
        <div class="ui center aligned content">
            <label>ID# <strong><?= $model->applicant_id ?></strong></label>
            <div class="header">
                <?= Html::a(DataHelper::name($model->applicant['first_name'], $model->applicant['middle_name'], $model->applicant['last_name']), ['applicant/view?id=' . $model->applicant_id], ['class' => '']) ?>
            </div>
            <div class="meta">
            </div>
        </div>
        <div class="extra content">
            <label class="left floated student-id"><span><?= $model->getGradeLevelName($model->applicant['grade_level_id']) ?></span></label>
            <span class="right floated">
                <?php if($model->applicant['sped'] === 0) : ?><div class="ui star rating sped" data-rating="1"><div class="icon active" style="font-size:  16px;"></div></div><?php endif ?>
            </span>
        </div>
    </div>
</div>
<?php Pjax::end() ?>