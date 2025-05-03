<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;
use yii\helpers\Url;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $url
 * @property int $is_active
 * @property int $created_by
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
            [['created_by'], 'integer'],
        ];
    }

    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'is_active' => 'Active Status',
            'created_by' => 'Created By',
        ];
    }
}