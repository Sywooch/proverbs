<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageUploadForm */

$this->title = 'Update Image Upload Form: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Image Upload Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-upload-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
