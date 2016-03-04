<?php

use app\rbac\models\AuthAssignment;
if (!Yii::$app->user->isGuest)
	$role = AuthAssignment::getAssignment(Yii::$app->user->identity->id);
?>
<div class="sidebar">
	<div class="sidebar-content">
		<ul class="navigation">
			<li <?= Yii::$app->controller->id === 'dashboard' ? 'class="active"' : ''?>><a href="<?= Yii::$app->controller->id === '/dashboard' ? '#' : Yii::$app->request->baseUrl . '/dashboard'?>"><span>Dashboard </span> <i class="icon-screen2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'board' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/board'?>"><span>Message Board</span> <i class="icon-bars"></i></a></li>
			<li <?= Yii::$app->controller->id === 'assessment' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/assessment'?>"><span>Assessment</span> <i class="icon-bars"></i></a></li>
			<li <?= Yii::$app->controller->id === 'class-adviser' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/class-adviser'?>"><span>Classs Adviser</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'assign-subject' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/assign-subject'?>"><span>Assign Subjects</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'section' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/section'?>"><span>Section</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'enroll' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/enroll'?>"><span>Enroll</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'profile' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/profile'?>"><span>Profile</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'nursery' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/nursery'?>"><span>Nursery</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'kinder-one' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/kinder-one'?>"><span>Kinder 1</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'kinder-two' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/kinder-two'?>"><span>Kinder 2</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'sped' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/sped'?>"><span>SPED</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-one' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-one'?>"><span>Grades 1-3</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-four' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-four'?>"><span>Grades 4-6</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-seven' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-seven'?>"><span>Grades 7-10</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-eleven-first-sem' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-eleven-first-sem'?>"><span>Grade 11 1st Sem</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-eleven-second-sem' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-eleven-second-sem'?>"><span>Grades 11 2nd Sem</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-twelve-first-sem' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-twelve-first-sem'?>"><span>Grade 12 1st Sem</span> <i class="icon-paragraph-justify2"></i></a></li>
			<li <?= Yii::$app->controller->id === 'grade-twelve-second-sem' ? 'class="active"' : ''?>><a href="<?= Yii::$app->request->baseUrl . '/grade-twelve-second-sem'?>"><span>Grade 12 2nd Sem</span> <i class="icon-paragraph-justify2"></i></a></li>
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
	</div>
</div>