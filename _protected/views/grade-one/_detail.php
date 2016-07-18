<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
?>
<?php Pjax::begin(['id' => 'grade-one-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<table class="ui celled striped small table">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th class="center aligned">First</th>
				<th class="center aligned">Second</th>
				<th class="center aligned">Third</th>
				<th class="center aligned">Fourth</th>
				<th class="center aligned">Average</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>English</td>
				<?php foreach($models as $model): ?>
					<?php if($model['subject_1'] === 0): ?>
						<td class="center aligned">&nbsp;</td>
					<?php else: ?>
						<td class="center aligned"><?= $model['subject_1'] ?></td>
					<?php endif; ?>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Math</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_2'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Science</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_3'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Civics</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_4'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Christian Education</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_5'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>MTB</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_6'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>MAPEH</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_7'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Filipino</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['subject_8'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Makadiyos</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['core_value_1'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Makatao</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['core_value_2'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Makakalikasan</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['core_value_3'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Makabansa</td>
				<?php foreach($models as $model): ?>
				<td class="center aligned"><?= $model['core_value_4'] ?></td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
    <?php Pjax::end(); ?>
</div>
