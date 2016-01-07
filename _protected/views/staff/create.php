<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $role app\rbac\models\Role */

$this->title = Yii::t('app', 'New Staff');
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
?>
<div class="staff-create">
    <?= $this->render('_form', [
        'user' => $user,
        'role' => $role,
    ]) ?>
</div>

