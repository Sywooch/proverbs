<?php
namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\rbac\models\AuthAssignment;

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

		$item = Html::tag('div', implode('<br>',[$button1, $button2]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item, ['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function generateCreateDisabled($options){

		$button1 = Html::button('Add', ['type' => 'submit', 'class' => 'ui link disabled fluid huge primary button']);

		$button2 = Html::a('Cancel', ['/' . Yii::$app->controller->id], ['class' => 'ui link fluid huge grey button']);

		$item = Html::tag('div', implode('<br>',[$button1, $button2]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item, ['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function generateView($options){

		$button1 = Html::a('New', ['create'], ['class' => 'ui link fluid huge primary button']);

		$button2 = Html::a('Edit', ['update', 'id' => $options['id']], ['class' => 'ui link fluid huge teal button']);

		$button = '';

		switch (Yii::$app->controller->id) {
			case 'applicant':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;
			case 'assessment':
				$button1 = '';
				$button3 = '';

				break;

			case 'assign-subject':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'students':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = '';
					//$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'payments':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = '';
					//$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'enroll':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = '';
					//$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'entrance-exam':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = '';
					//$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'school-year':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = '';
					//$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'section':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'){
					$button3 = '';
				}else {
					$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				}
				break;

			case 'profile':
				$button1 = '';
				$button3 = '';

				break;

			case 'grade-one':
				$button3 = '';

				break;

			case 'request':
				$button1 = '';

				if(
					AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'principal' ||
					AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'teacher' ||
					AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'cashier' ||
					AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff'
				){
					$button3 = '';
				}else {
					//$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
					$button3 = Html::a('Delete', ['delete', 'id' => $options['id']] ,
									[
										'id' => 'delete',
										'class' => 'ui link fluid huge grey button',
										'data' => [
											'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
											'method' => 'post',
										]
									]);
				}
				break;

			case 'user':
				$button3 = '';

				break;
			default:
				$button3 = Html::button('Delete', ['id' => 'delete', 'class' => 'ui link fluid huge grey button']);
				break;
		}


		$item = Html::tag('div', implode('<p></p>',[$button1, $button2, $button3]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item,['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function generateUpdate($options){
		switch (Yii::$app->controller->id) {
			case 'entrance-exam':
				if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'principal'){
					$button1 = Html::button('Save', ['type' => 'submit','class' => 'ui link fluid huge primary button']);
				}else {
					$button1 = '';
				}
				break;

			default:
				$button1 = Html::button('Save', ['type' => 'submit','class' => 'ui link fluid huge primary button']);
				break;
		}


		$button2 = Html::a('View', ['view', 'id' => $options['id']], ['class' => 'ui link fluid huge teal button']);

		$button3 = Html::a('Cancel', ['/' . Yii::$app->controller->id], ['class' => 'ui link fluid huge grey button']);

		$item = Html::tag('div', implode('<p></p>',[$button1, $button2, $button3]),['class' => 'item']);

		$template = Html::tag('div', '<div class="ui fluid huge label item"><span>Options</span></div>' . $item,['class' => ['ui fluid vertical menu']]);

		return $template;
	}

	public function render($options){

		if($options['scenario'] === 'create'){
			if($options['exist'] === true){
				return self::generateCreateDisabled($options);
			}else {
				return self::generateCreate($options);
			}
		}elseif($options['scenario'] === 'view'){
			if(Yii::$app->controller->id === 'request'){
				return self::generateView($options);
			}else {
				return self::generateView($options);
			}
		}elseif($options['scenario'] === 'update'){
			return self::generateUpdate($options);
		}
	}
}
?>
