<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $url
 * @property int $is_active
 */
class Link extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%links}}';
    }

    public function rules()
    {
        return [
            [['url'], 'required'],
            [['is_active'], 'boolean'],
            [['is_active'], 'default', 'value' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'is_active' => 'Active Status',
        ];
    }
}