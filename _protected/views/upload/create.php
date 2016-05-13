<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImageUploadForm */

$this->title = 'Create Image Upload Form';
$this->params['breadcrumbs'][] = ['label' => 'Image Upload Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-upload-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
