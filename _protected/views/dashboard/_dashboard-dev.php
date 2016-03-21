<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
$this->title = 'Dev';
use app\models\SchoolYear;
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<ul class="info-blocks">
			<li class="bg-primary">
				<div class="top-info">
					<a href="<?= Yii::$app->request->baseUrl . '/announcement' ?>">Announcements</a>
					<small>&nbsp;</small>
				</div>
				<a href="<?= Yii::$app->request->baseUrl . '/announcement' ?>"><i class="icon-flag"></i></a>
				<span class="bottom-info bg-danger"><?= Yii::$app->controller->countAnnouncement() ?> Announcements</span>
			</li>
			<li class="bg-success">
				<div class="top-info">
					<a href="<?= Yii::$app->request->baseUrl . '/students' ?>">Students</a>
					<small>&nbsp;</small>
				</div>
				<a href="<?= Yii::$app->request->baseUrl . '/students' ?>"><i class="icon-list"></i></a>
				<span class="bottom-info bg-primary"><?= Yii::$app->controller->countStudents() ?> Active Students</span>
			</li>
			<li class="bg-danger">
				<div class="top-info">
					<a href="<?= Yii::$app->request->baseUrl . '/user' ?>">Users</a>
					<small>&nbsp;</small>
				</div>
				<a href="<?= Yii::$app->request->baseUrl . '/user' ?>"><i class="icon-user"></i></a>
				<span class="bottom-info bg-primary"><?= Yii::$app->controller->countUsers() ?> Users</span>
			</li>
			<li class="bg-info">
				<div class="top-info">
					<a href="<?= Yii::$app->request->baseUrl . '/board' ?>">Board Messages</a>
					<small>&nbsp;</small>
				</div>
				<a href="<?= Yii::$app->request->baseUrl . '/board' ?>"><i class="icon-bubbles3"></i></a>
				<span class="bottom-info bg-primary"><?= Yii::$app->controller->countBoard() ?> Messages</span>
			</li>
			<li class="bg-warning">
				<div class="top-info">
					<a href="<?= Yii::$app->request->baseUrl . '/applicant' ?>">Applicants</a>
					<small>&nbsp;</small>
				</div>
				<a href="<?= Yii::$app->request->baseUrl . '/applicant' ?>"><i class="icon-numbered-list"></i></a>
				<span class="bottom-info bg-primary"><?= Yii::$app->controller->countApplicant() ?> Applicants</span>
			</li>
			<li class="bg-primary">
				<div class="top-info">
					<a href="<?= Yii::$app->request->baseUrl . '/enroll' ?>">Enrolled</a>
					<small>&nbsp;</small>
				</div>
				<a href="<?= Yii::$app->request->baseUrl . '/enroll' ?>"><i class="icon-stats2"></i></a>
				<span class="bottom-info bg-danger"><?= Yii::$app->controller->countCurrentEnrolled() ?> Currently Enrolled</span>
			</li>
		</ul>
	</div>
</div>