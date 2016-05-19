<?php
use yii\helpers\Html;

?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image">
			<?= substr(ucfirst('adfadadf'),0,1) ?>
			<img src="<?= Yii::$app->request->baseUrl . '/uploads/ui/section-bg.jpg' ?>" class="tiny image">
		</div>
		<div class="ui center aligned content">
			<p></p>
			<div class="header">
				<?= $model->section_name ?>
			</div>
		</div>
		<div class="extra content">
			<label class="left floated user-id"><span><?= $model->gradeLevel->name ?></span></label>
		</div>
	</div>
</div>