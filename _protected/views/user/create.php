<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $role app\rbac\models\Role */

$this->title = Yii::t('app', 'Create New User');
?>
<div class="user-create">
    <div class="col-lg-5 well bs-component">

        <?= $this->render('_form', [
            'user' => $user,
            'role' => $role,
        ]) ?>

    </div>

</div>

