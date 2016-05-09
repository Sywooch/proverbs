<?php
use yii\helpers\Html;
use app\models\Board;
use app\models\DataCenter;
use app\models\UiListView;
use yii\widgets\Pjax;

?>
<div id="board-content" style="padding: 0 0 0 10px; width: 100%;">
	<?php Pjax::begin(['id' => 'board-list']); ?>
        <?= UiListView::widget([
           'dataProvider' =>  DataCenter::recentBoard(Yii::$app->session->get('boardSize')),
           'options' => ['class' => 'ui fitted items', 'id' => 'bm'],
           'layout' => '{items}',
            'itemView' => '_board-list',
        ]); ?>
	<?php Pjax::end(); ?>
	<div style="text-align: center; margin: 10px 0;"><button id="view-more-board" class="ui fluid basic small circular button">View More</button></div>
</div>