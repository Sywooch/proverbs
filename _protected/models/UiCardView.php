<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
* 
*/
class UiCardView extends ListView
{
	public $options = ['class' => 'ui four stackable cards'];
	public $separator = "";
	public $itemOptions = ['class' => 'card'];
	public $pager = [];
	public $layout = "{items}";
}

?>