<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\base\Model;
use app\models\User;
use app\models\Board;
use app\models\BoardSearch;
use yii\data\ActiveDataProvider;
$this->title = "Ajax";

$yesterday = time() - (1 * 24 * 60 * 60);
$object = Board::find()->where(['between' ,'created_at' , $yesterday, time()])->all();
?>

<?php
	echo Html::a('Click me', ['ajax/fetch'], [
        'id' => 'ajax_link_01',
        'data-on-done' => 'fetch',
    ]
);
 
$this->registerJs("$('#ajax_link_01').click(handleAjaxLink);", View::POS_READY);
?>

<?php
echo Html::beginForm('', 'post', ['id' => 'link_form']);
 
echo "<div>" . Html::label('Name', 'name') . " "
    . Html::textInput('name', null, ['id' => 'name']) . "</div>";
 
echo "<div>" . Html::label('E-mail', 'email') . " "
    . Html::input('email', 'email', null, ['id' => 'email']) . "</div>";
 
echo Html::a('Click me', ['ajax/link-form'], [
        'id' => 'ajax_link_02',
        'data-on-done' => 'linkFormDone',
        'data-form-id' => 'link_form',
    ]
);
 
echo Html::endForm();
 
echo Html::tag('pre', '...', ['id' => 'ajax_result_02']);
 
$this->registerJs("$('#ajax_link_02').click(handleAjaxLink);", View::POS_READY);
?>
