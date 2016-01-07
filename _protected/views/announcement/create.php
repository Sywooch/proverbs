<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = 'New Announcement';
$this->params['breadcrumbs'][] = ['label' => 'Announcements', 'url' => ['index']];
?>
<div class="announcement-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
