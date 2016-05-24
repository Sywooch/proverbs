<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\UiListView;
use app\models\BoardSearch;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$searchModel = new BoardSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$this->title = 'Boards';
?>
<div id="a" style="width: 100%; top: 0; position: fixed;">
<div style="min-height: 74px; background: red;"></div>
	<div class="ui segment">
		<div id="board-index" class="ui fluid container">
			<div>
				<?php Pjax::begin(['id' => 'class-adviser-list', 'timeout' => 60000]); ?>
				    <?= UiListView::widget([
				    	'layout' => '{items}',
				    	'dataProvider' => $dataProvider,
				        'itemView' => '_board-list-dedicated',
				    ]); ?>
				<?php Pjax::end(); ?>
			</div>
		</div>
	</div>
</div>