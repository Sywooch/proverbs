<?php
namespace app\rbac\models;


use app\rbac\models\AuthAssignment;
use app\models\User;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string  $name
 * @property integer $type
 * @property string  $description
 * @property string  $rule_name
 * @property string  $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class AuthItem extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    public static function getRolesArray()
    {

        if (!Yii::$app->user->isGuest){
            $role = AuthAssignment::getAssignment(Yii::$app->user->identity->id);
        }

        if ($role === 'dev' || $role === 'master')
        {
            $roles = self::find()->select('name')->where(['type' => 1])->all();

        }
        else
        {
            $roles = self::find()->select('name')
                                 ->where(['type' => 1])
                                 ->andWhere(['!=', 'name', 'dev'])
                                 ->andWhere(['!=', 'name', 'master'])
                                 ->all();
        }

        $rolesArray = [];

        for ($i=0; $i < count($roles); $i++) { 
            $rolesArray[$roles[$i]->name] = ucfirst($roles[$i]->name);
        }

        return $rolesArray;
    }

    public static function getRoles()
    {

        if (!Yii::$app->user->isGuest){
            $role = AuthAssignment::getAssignment(Yii::$app->user->identity->id);
        }

        if ($role === 'dev' || $role === 'master')
        {
            return static::find()->select('name')->where(['type' => 1])->all();

        }
        else
        {
            return static::find()->select('name')
                                 ->where(['type' => 1])
                                 ->andWhere(['!=', 'name', 'dev'])
                                 ->andWhere(['!=', 'name', 'master'])
                                 ->all();
        }
    }

    public static function getParentRole(){
        return static::find()->select('name')
                             ->where(['type' => 1])
                             ->andWhere(['=', 'name', 'parent'])
                             ->all();
    }   

    public static function getDevRole(){
        return static::find()->select('name')
                             ->where(['type' => 1])
                             ->andWhere(['=', 'name', 'dev'])
                             ->all();
    }
}
