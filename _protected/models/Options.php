<?php 
namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class Options
{
	/*  
	<?= Options::render($options = [
			'scenario' => Yii::
			'id' => $model->id
    ]) ?>
    */
	
	public function generateCreate($options){

		$button1 = Html::button('Add', ['type' => 'submit', 'class' => 'ui link fluid huge primary button']);

		$button2 = Html::a('Cancel', ['/' . Yii::$app->controller->id], ['class' => 'ui link fluid huge grey button']);

		$item = Html::tag('div', implode('<p></p>',[$button1, $button2]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item,['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function generateView($options){

		$button1 = Html::a('New', ['create'], ['class' => 'ui link fluid huge primary button']);

		$button2 = Html::a('Edit', ['update', 'id' => $options['id']], ['class' => 'ui link fluid huge teal button']);
		
		$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);

		$item = Html::tag('div', implode('<p></p>',[$button1, $button2, $button3]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item,['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function generateUpdate($options){

		$button1 = Html::button('Save', ['type' => 'submit','class' => 'ui link fluid huge primary button']);

		$button2 = Html::a('View', ['view', 'id' => $options['id']], ['class' => 'ui link fluid huge teal button']);
		
		$button3 = Html::a('Cancel', ['/' . Yii::$app->controller->id], ['class' => 'ui link fluid huge grey button']);

		$item = Html::tag('div', implode('<p></p>',[$button1, $button2, $button3]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item,['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function render($options){

		if($options['scenario'] === 'create'){
			return self::generateCreate($options);
		}elseif($options['scenario'] === 'view'){
			return self::generateView($options);
		}elseif($options['scenario'] === 'update'){
			return self::generateUpdate($options);
		}
	}
}
?>