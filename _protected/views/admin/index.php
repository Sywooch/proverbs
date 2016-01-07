<?php
use app\rbac\models\AuthAssignment;

if (!Yii::$app->user->isGuest) $role = AuthAssignment::getAssignment(Yii::$app->user->identity->id);

$this->title = Yii::t('app', 'Dashboard');
?>

<div class="admin-default-index">
    <?= 'user: ' . $role ?>
</div>