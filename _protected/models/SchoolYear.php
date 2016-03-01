<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_year".
 *
 * @property string $id
 * @property string $sy
 */
class SchoolYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sy'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sy' => 'Sy',
        ];
    }

    public function getSyItem()
    {
        $item = new SchoolYear();
        return $item;
    }
}
