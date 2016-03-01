<?php
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<?php
if($model->user->gender === 1){
	//EMPTY PROFILE IMG
	if(empty($model->user->profile_image) || $model->user->profile_image === null){

		//FEMAL USER, NO PROFILE IMG IS SAME PERSON AS POSTED BY
		if($model->posted_by === Yii::$app->user->identity->id){
    		$foto = Yii::$app->request->baseUrl . '/uploads/user-thumb/female.png';

    		echo
    		'<div class="board-message-format">
    			<div class="row">
    				<div class="self-thumb">'
						. '<img class="message-profile-thumbnail" src="' . $foto
						. '" alt="' . $model->postedBy->username . '"><p></p><small class="pull-left">'. $model->postedBy->username . '</small>
    				</div>
    				<div class="pre-wrap self"><pre class="message-separator self">'
						. Html::encode($model->content)
    					. '</pre><br/><small class="pull-left">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans() . '</small>'
    				. '</div>'
    				
    			. '</div>
			</div>'
			. '<small class="separator"><hr></small>';
		}
		//FEMAL USER, NO PROFILE IMG IS NOT THE SAME PERSON AS POSTED BY
		else {
    		$foto = Yii::$app->request->baseUrl . '/uploads/user-thumb/female.png';

    		echo 
    		'<div class="board-message-format">
    			<div class="row">
    				<div class="thumb">'
						. '<img class="message-profile-thumbnail" src="' . $foto
						. '" alt="' . $model->postedBy->username . '">
    				</div>
    				<div class="pre-wrap user"><pre class="message-separator">'
						. Html::encode($model->content)
    				. '</pre><small class="pull-right">'. $model->postedBy->username . '</small><br/><small class="pull-right">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans() . '</small></div>'
    			. 	'</div>
			</div>'
			. '<small class="separator"><hr></small>';
		}
	}
	//FEMALE USER HAS PROFILE IMG
	else {
		$foto = Yii::$app->request->baseUrl . '/uploads/user-thumb/female.png';
	}

//MALE
} else {
	//EMPTY PROFILE IMG
	if(empty($model->user->profile_image) || $model->user->profile_image === null){

		//MALE USER, NO PROFILE IMG IS SAME PERSON AS POSTED BY
		if($model->posted_by === Yii::$app->user->identity->id){
    		$foto = Yii::$app->request->baseUrl . '/uploads/user-thumb/male.png';

    		echo 
    		'<div class="board-message-format">
    			<div class="row">
    				<div class="pre-wrap"><pre class="message-separator self">'
						. Html::encode($model->content)
    					. '</pre><small class="pull-left">'. $model->postedBy->username . '</small><br/><small class="pull-left">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans() . '</small>'
    				. '</div>
    				<div class="thumb">'
						. '<img class="message-profile-thumbnail" src="' . $foto
						. '" alt="' . $model->postedBy->username . '">
    				</div>'
    			. '</div>
			</div>'
			. '<small class="separator"><hr></small>';
		}
		//MALE USER, NO PROFILE IMG IS NOT THE SAME PERSON AS POSTED BY
		else {
    		$foto = Yii::$app->request->baseUrl . '/uploads/user-thumb/male.png';

    		echo 
    		'<div class="board-message-format">
    			<div class="row">
    				<div class="thumb">'
						. '<img class="message-profile-thumbnail" src="' . $foto
						. '" alt="' . $model->postedBy->username . '">
						<p></p><small class="pull-left">'. $model->postedBy->username . '</small>
    				</div>
    				<div class="pre-wrap user"><pre class="message-separator">'
						. Html::encode($model->content)
    				. '</pre><br/><small class="pull-right">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans() . '</small></div>'
    			. 	'</div>
			</div>'
			. '<small class="separator"><hr></small>';
		}
	}
	//MALE USER, HAS PROFILE IMG
	else {
		$foto = Yii::$app->request->baseUrl . '/uploads/user-thumb/female.png';
	}
}
?>