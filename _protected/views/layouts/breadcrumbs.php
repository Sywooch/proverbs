<?php

use app\widgets\Alert;
use yii\widgets\Breadcrumbs;
?>

<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
<?= Alert::widget() ?>