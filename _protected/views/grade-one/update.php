<?php
use yii\helpers\Html;
?>
<div class="grade-one-form-update">
    <?= $this->render('_form', [
        'model' => $model,
        'eid' => $eid,
        'grading' => $grading,
    ]) ?>
</div>
