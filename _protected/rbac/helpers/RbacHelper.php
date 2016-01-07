<?php
namespace app\rbac\helpers;

use app\models\User;
use app\rbac\models\Role;
use Yii;

class RbacHelper
{
    public static function assignRole($id)
    {
        Role::deleteAll(['user_id' => $id]);

        $usersCount = User::find()->count();

        $auth = Yii::$app->authManager;

        // FIRST USER
        if ($usersCount == 1)
        {
            $role = $auth->getRole('dev');
            $auth->assign($role, $id);
        } 
        else 
        {
            $role = $auth->getRole('parent');
            $auth->assign($role, $id);
        }

        return $role->name;
    }
}

