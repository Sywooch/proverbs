<?php 
use app\rbac\models\AuthAssignment;
use yii\helpers\Html;
?>

<?php 
if(!Yii::$app->user->isGuest){
	switch (AuthAssignment::getAssignment(Yii::$app->user->identity->id)) {
		case 'dev':
			echo $this->render('_dev-menu');
			break;
		case 'master':
			echo $this->render('_master-menu');
			break;
		
		case 'admin':
			echo $this->render('_admin-menu');
			break;
		
		case 'principal':
			echo $this->render('_principal-menu');
			break;
		
		case 'teacher':
			echo $this->render('_teacher-menu');
			break;
		
		case 'cashier':
			echo $this->render('_cashier-menu');
			break;
		
		case 'staff':
			echo $this->render('_staff-menu');
			break;

		case 'parent':
			echo $this->render('_parent-menu');
			break;
		
		default:
			# code...
			break;
	}

}
?>