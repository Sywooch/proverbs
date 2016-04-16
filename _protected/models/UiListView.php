<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
* 
*/
class UiListView extends ListView
{
	public $options = ['class' => 'ui small middle aligned divided list'];
	public $separator = "";
	public $itemOptions = ['class' => 'item', 'style' => 'padding: 10px 0;'];
	public $pager = [];
	public $layout = "{summary}{pager}{items}{pager}";
}

?>