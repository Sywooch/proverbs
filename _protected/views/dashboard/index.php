<?php
	if(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'dev'){
		echo $this->render('_dashboard-dev');

	} elseif(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'master'){
		echo $this->render('_dashboard-master');

	} elseif(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'staff'){
		echo $this->render('_dashboard-staff');

	} elseif(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'admin'){
		echo $this->render('_dashboard-admin');

	} elseif(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'cashier'){
		echo $this->render('_dashboard-cashier');

	} elseif(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'parent'){
		echo $this->render('_dashboard-parent');

	} elseif(Yii::$app->authManager->getRole(Yii::$app->user->identity->id)->name === 'teacher'){
		echo $this->render('_dashboard-teacher');

	}
?>
