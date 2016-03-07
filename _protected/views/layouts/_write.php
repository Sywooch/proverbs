<?php

use yii\helpers\Html;
use yii\web\View;

echo Html::beginForm('', 'post', ['id' => 'write-form']) .
        '<div id="write-form-textarea">' .
            '<div class="form-group field-board-content">' .
                Html::textarea('content', null, ['id' => 'write-textarea', 'type' => 'textarea', 'class' => 'form-control', 'maxlength' => 255, 'rows' => 1, 'style' => 'margin: 0;']) .
                '<a id="write-board-send" href="' . Yii::$app->request->baseUrl . '/ajax/push' . '" class="btn btn-block btn-primary" style="margin-top: 10px;" data-on-done="linkFormDone" data-on-fail="linkFormFail" data-form-id="write-form">SEND</a>
            </div>
        </div>';
echo Html::endForm();
$this->registerJs("$('#write-board-send').click(handleAjaxLink);", View::POS_READY);
?>