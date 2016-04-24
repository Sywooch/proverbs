<?php 
namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class Card
{
	public $header;
	public $extra_content;
	public $left_floated;
	public $right_floated;
	public $avatar;
	public $options;
	public $card;
	public $content;
	public $template;

	/*  
	<?= Card::render($options = [
        'imageContent' => '',
        'labelContent' => !$model->isNewRecord ? 'ID# ' . $model->applicant_id : '&nbsp;',
        'labelFor' => 'Applicant ID',
        'labelOptions' => '',
        'headerContent' => '&nbsp;',
        'headerOptions' => '',
        'metaContent' => '',
        'metaOptions' => '',
        'leftFloatedContent' => '&nbsp;',
        'leftFloatedFor' => '',
        'leftFloatedOptions' => '',
        'rightFloatedContent' => '',
        'rightFloatedOptions' => !$model->isNewRecord ? 'hidden' : $class
    ]) ?>
    */
	
	public function generateTemplate($options){

		$header = Html::tag('div', $options['headerContent'], ['class' => implode(' ', ['header', $options['headerOptions'] ]), 'id' => 'header-content' ]);

		$label = Html::label($options['labelContent'], $options['labelFor'], ['class' => $options['labelOptions'], 'id' => 'header-label' ]);

		$meta = Html::tag('div', implode('',['<span id="meta-content">&nbsp;', $options['metaContent'],'</span>']), ['class' => implode(' ',['meta', $options['metaOptions']] )]);

		$content = Html::tag('div', $label . $header . $meta, ['class' => 'ui center aligned content']);

		$left_floated = Html::label($options['leftFloatedContent'], $options['leftFloatedFor'], ['id' => 'left-content', 'class' => $options['leftFloatedOptions'], 'style' => 'color: #555; font-weight: 600;']);

		$right_floated = Html::tag('span', Html::tag('div', '<div class="icon active" style="font-size: 16px;"></div>' ,['id' => 'right-content', 'class' => implode(' ', ['ui star rating', $options['rightFloatedOptions']]) ]), ['class' => 'right floated', 'data-rating' => 1]);

		$extra_content = Html::tag('div', implode('',['<span class="left floated">', $left_floated. '</span>' . $right_floated]), ['class' => 'extra content']);

		$image = Html::tag('div', Html::img($options['imageContent'],['class' => 'tiny image']),['class' => ['image']]);

		$card = Html::tag('div', $image . $content . $extra_content, ['class' => ['card']]);

		$template = Html::tag('div', $card,['class' => ['ui center aligned stackable cards']]);

		return $template;
	}

	public function render($options){
		return self::generateTemplate($options);
	}
}
?>