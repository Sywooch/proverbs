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
        if ($usersCount === 1)
        {
            $role = 'dev';
            $auth->assign($role, $id);
            
            return $role;
        } 
        else 
        {
            $role = 'parent';
            $auth->assign($role, $id);
            
            return $role;
        }
        
    }
}