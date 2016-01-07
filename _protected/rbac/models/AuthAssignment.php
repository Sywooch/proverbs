<?php
namespace app\rbac\models;

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
class AuthAssignment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    public static function getAssignment($user_id)
    {
        $item_name = static::find()->select('item_name')->where(['user_id' => $user_id])->one();
        
        foreach ($item_name as $item) {
            return $item;
        }
        
        return null;
    }        
}
