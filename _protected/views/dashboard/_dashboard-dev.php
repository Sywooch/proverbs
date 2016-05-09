<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\Board;
use app\models\DataCenter;
use app\models\SchoolYear;
$this->title = 'Dev';

?>
<div class="ui fluid segment">
	<p><span>Size: </span><span id="a_new_size"><?= Yii::$app->session->get('announcementSize') ?></span></p>
	<p><span>Board Size: </span><span id="b_new_size"><?= Yii::$app->session->get('boardSize') ?></span></p>
</div>
<?php 
//Yii::$app->session->set('announcementSize', 10);
?>