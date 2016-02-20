<?php

use app\rbac\models\AuthAssignment;
if (!Yii::$app->user->isGuest)
	$role = AuthAssignment::getAssignment(Yii::$app->user->identity->id);
?>
<!-- Sidebar -->
<div class="sidebar">
	<div class="sidebar-content">
		<!-- Main navigation -->
		<ul class="navigation">
			<li <?= Yii::$app->controller->id === $role ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/' . $role;?>"><span>Dashboard </span> <i class="icon-screen2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'assessment' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/assessment'?>"><span>Assessment</span> <i class="icon-bars"></i></a></li>
			<li <?= Yii::$app->controller->id === 'enroll' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/enroll'?>"><span>Enroll</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'profile' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/profile'?>"><span>Profile</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grades' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grades'?>"><span>Grades</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'user' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/user'?>"><span>User</span> <i class="icon-user"></i></a></li>
			<li <?= Yii::$app->controller->id === 'cashier' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/cashier'?>"><span>Cashier</span> <i class="icon-user"></i></a></li>
			<li <?= Yii::$app->controller->id === 'staff' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/staff'?>"><span>Staff</span> <i class="icon-user"></i></a></li>
			<li <?= Yii::$app->controller->id === 'teachers' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/teachers'?>"><span>Teachers</span> <i class="icon-user"></i></a></li>
			<li><a href="<?= Yii::$app->request->baseUrl . '/gii'?>"><span>Gii</span> <i class="icon-grid"></i></a></li>
			<li <?= Yii::$app->controller->id === 'announcement' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/announcement'?>"><span>Announcement</span> <i class="icon-bullhorn"></i></a></li>
			<li <?= Yii::$app->controller->id === 'students' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/students'?>"><span>Students</span> <i class="icon-numbered-list"></i></a></li>
			<li <?= Yii::$app->controller->id === 'payments' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/payments'?>"><span>Payments</span> <i class="icon-bars"></i></a></li>
			<li <?= Yii::$app->controller->id === 'messages' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/messages'?>"><span>Messages</span> <i class="icon-bubble6"></i></a></li>
			<li <?= Yii::$app->controller->id === 'applicant' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/applicant'?>"><span>Applicant</span> <i class="icon-table2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'entrance-exam' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/entrance-exam'?>"><span>Entrance Examinees</span> <i class="icon-numbered-list"></i></a></li></li>
		</ul>
		<!-- /main navigation -->
	</div>
</div>
<!-- /sidebar -->