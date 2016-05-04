<?php 
use app\rbac\models\AuthAssignment;
use app\models\DataHelper;
use yii\helpers\Html;
?>

<?php 
if(!Yii::$app->user->isGuest){
	switch (AuthAssignment::getAssignment(Yii::$app->user->identity->id)) {
		case 'dev':
			echo DataHelper::menu('dev');
			break;

		case 'master':
			echo DataHelper::menu('master');
			break;
		
		case 'admin':
			echo DataHelper::menu('admin');
			break;
		
		case 'principal':
			echo DataHelper::menu('principal');
			break;
		
		case 'teacher':
			echo DataHelper::menu('teacher');
			break;
		
		case 'cashier':
			echo DataHelper::menu('cashier');
			break;
		
		case 'staff':
			echo DataHelper::menu('staff');
			break;
			
		default:
			echo DataHelper::menu('parent');
			break;
	}
}
?>