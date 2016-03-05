<?php
	if(Yii::$app->user->is('admin')){
		include('_dashboard-admin.php');

	} elseif(Yii::$app->user->is('cashier')){
		include('_dashboard-cashier.php');

	} elseif(Yii::$app->user->is('dev')){
		include('_dashboard-dev.php');

	} elseif(Yii::$app->user->is('master')){
		include('_dashboard-master.php');

	} elseif(Yii::$app->user->is('staff')){
		include('_dashboard-staff.php');

	} elseif(Yii::$app->user->is('parent')){
		include('_dashboard-parent.php');

	} elseif(Yii::$app->user->is('teacher')){
		include('_dashboard-teacher.php');

	}

?>