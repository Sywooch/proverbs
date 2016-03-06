<?php
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<?php
	//USER === POSTED_BY
	if($model->posted_by === Yii::$app->user->id){
		if($model->postedBy->gender === 0){//MALE
			//USER HAS PROFILE IMAGE
			if(!empty($model->postedBy->profile_image) || $model->postedBy->profile_image !== null){
				echo '<div class="board-message-format-self">
						<ul>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/profile-img/' .  $model->postedBy->profile_image; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
						</ul>
					</div>
					<small class="separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';
			} else {//USER NO PROFILE IMAGE
				echo '<div class="board-message-format-self">
						<ul>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/user-thumb/male.png'; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
						</ul>
					</div>
					<small class="separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';
			}
		} else {//FEMALE
			//USER HAS PROFILE IMAGE
			if(!empty($model->postedBy->profile_image) || $model->postedBy->profile_image !== null){
				echo '<div class="board-message-format-self">
						<ul>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/profile-img/' .  $model->postedBy->profile_image; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
						</ul>
					</div>
					<small class="separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';
			} else {//USER NO PROFILE IMAGE
				echo '<div class="board-message-format-self">
						<ul>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/user-thumb/female.png'; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
						</ul>
					</div>
					<small class="separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';
			}
		}
	}
	else {//OTHER USERS
		if($model->postedBy->gender === 0){//MALE
			//OTHER USER HAS PROFILE IMAGE
			if(!empty($model->postedBy->profile_image) || $model->postedBy->profile_image !== null){
				echo '<div class="board-message-format-user">
						<ul>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/profile-img/' .  $model->postedBy->profile_image; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
						</ul>
					</div>
					<small class="other-separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';				
			} else {//OTHER MALE USER NO PROFILE IMAGE
				echo '<div class="board-message-format-user">
						<ul>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/user-thumb/male.png'; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
						</ul>
					</div>
					<small class="other-separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';
			}			
		} else {//FEMALE
			//OTHER USER HAS PROFILE IMAGE
			if(!empty($model->postedBy->profile_image) || $model->postedBy->profile_image !== null){
				echo '<div class="board-message-format-user">
						<ul>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/profile-img/' .  $model->postedBy->profile_image; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
						</ul>
					</div>
					<small class="other-separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';				
			} else {//OTHER FEMALE USER NO PROFILE IMAGE
				echo '<div class="board-message-format-user">
						<ul>
							<li>
								<img class="message-profile-thumbnail" src="'; echo Yii::$app->request->baseUrl . '/uploads/user-thumb/female.png'; echo '" alt="' . $model->postedBy->username . '">
								<p><small>' . $model->postedBy->username . '</small></p>
							</li>
							<li><pre>' . Html::encode($model->content) . '</pre></li>
						</ul>
					</div>
					<small class="other-separator"><hr><span id="timestamp">' . \Carbon\Carbon::createFromTimestamp($model->created_at, 'Asia/Manila')->diffForHumans(). '</span></small>';
			}
		}
	}
?>