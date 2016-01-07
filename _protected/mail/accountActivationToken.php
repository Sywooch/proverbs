<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$activationLink = Url::to(['site/activate-account', 'token' => $user->account_activation_token], true);
/*	Yii::$app->urlManager->createAbsoluteUrl(['site/activate-account', 
    'token' => $user->account_activation_token]);*/
?>
Hello <?= Html::encode($user->username) ?>,

Follow this link to activate your account:

<?= Html::a('Please, click here to activate your account.', $activationLink) ?>