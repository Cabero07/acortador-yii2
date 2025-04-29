<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `user_log`.
 */
class UserLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'action', 'performed_by'], 'required'],
            [['user_id', 'performed_by'], 'integer'],
            [['action'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * Relación con el usuario afectado.
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Relación con el administrador que realizó la acción.
     */
    public function getPerformedBy()
    {
        return $this->hasOne(User::class, ['id' => 'performed_by']);
    }
}