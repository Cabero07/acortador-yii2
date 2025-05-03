<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\db\ActiveRecord;
use yii\helpers\Url;


/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property string $url
 * @property string $short_code
 * @property string|null $title
 * @property string|null $description
 * @property int $is_active
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property User $creator
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
            [['url', 'short_code', 'user_id'], 'required'],
            [['description'], 'string'],
            [['is_active', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['url', 'title'], 'string', 'max' => 255],
            [['short_code'], 'string', 'max' => 50],
            [['short_code'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'short_code' => 'Short Code',
            'title' => 'Title',
            'description' => 'Description',
            'is_active' => 'Active Status',
            'user_id' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}