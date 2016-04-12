<?php
	$role = app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id);

	if($role === 'dev'){
		echo $this->render('_dashboard-dev');
	} elseif($role === 'master'){
		echo $this->render('_dashboard-master');

	} elseif($role === 'admin'){
		echo $this->render('_dashboard-admin');

	} elseif($role === 'staff'){
		echo $this->render('_dashboard-staff');

	} elseif($role === 'cashier'){
		echo $this->render('_dashboard-cashier');

	} elseif($role === 'principal'){
		echo $this->render('_dashboard-principal');

	} elseif($role === 'teacher'){
		echo $this->render('_dashboard-teacher');

	} elseif($role === 'parent'){
		echo $this->render('_dashboard-parent');

	} 
	
?>
