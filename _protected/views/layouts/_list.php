<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\DataHelper;
$avatar = DataHelper::avatar();
?>
<div class="ui mini image">
  <img src="<?= !empty($model->postedBy->profile_image) ? implode('', [Yii::$app->request->baseUrl, '/uploads/users/',$model->postedBy->profile_image]) : $avatar ?>" style="background: #f7f7f7;">
</div>
<div class="top aligned content">
	<div class="header" style="font-size: 12px; "><?= $model->postedBy->username ?>&nbsp;</div>
	<div class="description" style="margin-top: -1px;">
		<?= Html::encode($model->content) ?>
	</div>
	<div class="meta" style="margin: 0;"><div class="right aligned text"><small><?= DataHelper::carbonDateDiff($model->created_at)?></small></div></div>
</div>
<?php
$hvr = <<< JS
$(document).ready(function(){
		$('#bm > .item').hover(function(){
			//username	$(this.lastElementChild.firstElementChild.innerText).selector
			//content 	$(this.lastElementChild.firstElementChild.nextElementSibling.innerText).selector
			//date 		$(this.lastElementChild.firstElementChild.nextElementSibling.nextElementSibling.innerText).selector
			if($('body').hasClass('sidebar-narrow')){
				console.log( $(this.lastElementChild.firstElementChild.nextElementSibling.nextElementSibling.innerText).selector );
			}
		});
});
JS;
$this->registerJs($hvr);
?>