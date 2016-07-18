<?php
use yii\helpers\Html;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
//!empty($model->teacher->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->teacher->profile_image : $img = $avatar;
?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update', 'id' => $model->id]) ?></div>
<div class="ui tiny rounded image">
        <div class="image">
            <?php if(!empty($model->enrolled->student->students_profile_image)) : ?>
                <?= Html::img(['/thumbnail','id'=>$model->enrolled->student->students_profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
</div>
<div class="content">
	<label></label>
	<div class="ui medium header"></div>
	<div class="extra content">

	</div>
</div>
