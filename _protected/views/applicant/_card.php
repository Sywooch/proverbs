<?php 
    $def = Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png';
    !empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $def;
    $model->gender === 0 ? $gender = 'Male <i class="fa fa-mars fa-one-point-five"></i>' : $gender = 'Female <i class="fa fa-venus fa-one-point-five"></i>';
?>
<a class="image" href="<?= 'students/view?id=' . $model->id ?>">
    <img src="<?= $img ?>">
</a>
<div class="content">
    <a class="header" href="<?= 'students/view?id=' . $model->id ?>"><?= implode(' ', [$model->first_name, 
        !empty(trim($model->middle_name)) ? 
            ucfirst(substr($model->middle_name, 0,1)). '.' : 
            '', $model->last_name]) ?>
    </a>
    <div class="meta">
        <label><strong><?= ucfirst($model->nickname) ?></strong></label>
    </div>
    <div class="meta">
        <span><?= $gender ?></span>
    </div>
    <div class="description">
        <span><?= $model->gradeLevel->name ?></span>
    </div>
</div>