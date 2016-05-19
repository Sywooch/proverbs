<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->teacher->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->teacher->profile_image : $img = $avatar;
!empty(trim($model->teacher->middle_name)) ? $middle = ucfirst(substr($model->teacher->middle_name, 0,1)).'.' : $middle = '';
?>

<?php Pjax::begin(['id' => 'class-adviser-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
        <div class="image">
            <?php if(!empty($model->teacher->profile_image)) : ?>
                <?= Html::img(['/file','id'=>$model->teacher->profile_image]) ?>
            <?php else :?>
                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
            <?php endif ?>
        </div>
		<div class="ui center aligned content">
			<label><em><?= $model->teacher->email ?></em></label>
			<div class="header">
				<?= Html::a(DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name),['user/view', 'id' => $model->teacher->id],['class' => '']) ?>
			</div>
		    <div class="meta"><span id="meta-content"><?= implode('', ['\'', $model->teacher->username, '\'']) ?></span></div>
		</div>
		<div class="extra content">
			<span class="left floated">
				<label style="color: #555; font-weight: 600;"><?= DataHelper::gradeLevel($model->grade_level_id) ?><p style="color: rgba(0,0,0,.4);"><span style="font-size: 11px;">
				<?= DataHelper::schoolYear($model->sy_id) ?></span><br/>Adviser</p></label>
			</span>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>