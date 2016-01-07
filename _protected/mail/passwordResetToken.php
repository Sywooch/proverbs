<?php
use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 
    'token' => $user->password_reset_token]);
?>

Hello <?= Html::encode($user->username) ?>,

Follow this link to reset your password:

<?= Html::a('Please, click here to reset your password.', $resetLink) ?>
