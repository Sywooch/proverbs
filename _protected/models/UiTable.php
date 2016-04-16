<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
* 
*/
class UiTable extends DetailView
{
	public $model;
	public $attributes;
	public $options = ['class' => 'ui very basic table'];
	public $template = '<tr><td><strong>{label}</strong></td><td>{value}</td></tr>';
	public $formatter;
}
?>