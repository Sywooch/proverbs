<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $role app\rbac\models\Role */

$this->title = Yii::t('app', 'New');
?>
<div class="user-create">
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-6 col-md-6 col-sm-12">
			    <?= $this->render('_form', [
			        'user' => $user,
			        'role' => $role,
			    ]) ?>
			</div>
		</div>
	</div>
</div>
<p></p>