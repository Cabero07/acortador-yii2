<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `auth_assignment`.
 */
class AuthAssignment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * Relación con el usuario.
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Relación con el ítem de autorización.
     */
    public function getAuthItem()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'item_name']);
    }
}