<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->applicant['students_profile_image']) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->applicant['students_profile_image'] : $img = $avatar;
!empty(trim($model->applicant['middle_name'])) ? $middle = ucfirst(substr($model->applicant['middle_name'], 0,1)).'.' : $middle = '';
?>
<?php Pjax::begin(['id' => 'entrance-exam-card', 'timeout' => 10000, 'enablePushState' => false]); ?>
<div class="ui center aligned stackable cards">
    <div class="card">
        <div class="image"><img src="<?= $img ?>" class="tiny image"></div>
        <div class="ui center aligned content">
            <label>ID# <strong><?= $model->applicant_id ?></strong></label>
            <div class="header">
                <?= Html::a(implode(' ', [$model->applicant['first_name'], $middle, $model->applicant['last_name']]), ['applicant/view?id=' . $model->applicant_id], ['class' => '']) ?>
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