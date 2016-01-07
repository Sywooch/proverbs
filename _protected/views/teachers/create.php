<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $role app\rbac\models\Role */

$this->title = Yii::t('app', 'New Teacher');
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
?>
<div class="teacher-create">
    <?= $this->render('_form', [
        'user' => $user,
        'role' => $role,
    ]) ?>
</div>

