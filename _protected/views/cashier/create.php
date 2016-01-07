<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $role app\rbac\models\Role */

$this->title = Yii::t('app', 'New Cashier');
$this->params['breadcrumbs'][] = ['label' => 'Cashier', 'url' => ['index']];
?>
<div class="cashier-form-create">
    <?= $this->render('_form', [
        'user' => $user,
        'role' => $role,
    ]) ?>
</div>

