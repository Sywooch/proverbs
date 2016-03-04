<?php
$arr = array('sh' => Yii::$app->session->id, 'brd' => Yii::$app->params['brd'], 'sbr' => Yii::$app->params['sbr']);
$obj = json_encode($arr);
$temp = json_encode($obj);
$temp = <<< JS
var obj = jQuery.parseJSON($temp);
JS;
$this->registerJs($temp);
?>