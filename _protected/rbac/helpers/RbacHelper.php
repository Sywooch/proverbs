<?php
namespace app\rbac\helpers;

use app\models\User;
use app\rbac\models\Role;
use app\rbac\models\AuthItem;
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
            $array = (array) AuthItem::getDevRole();
            foreach ($array as $key) {
                $role = $key->name;
            }

            $auth->assign($role, $id);
            
            return $role;
        } 
        else 
        {
            $array = (array) AuthItem::getParentRole();
            foreach ($array as $key) {
                $role = $key->name;
            }
            $auth->assign($role, $id);
            
            return $role;
        }
        
    }
}