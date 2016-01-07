<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */

$this->title = ucfirst($model->username);
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
?>
<div class="profile-form-update">

    <h1>&nbsp;
    	<p class="pull-right">
                <?= Html::a(Yii::t('app', 'Back'), ['/profile'], ['class' => 'btn btn-warning']) ?>
        </p></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>