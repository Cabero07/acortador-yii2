<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `auth_rule`.
 */
class AuthRule extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * Relación con los ítems de autorización.
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::class, ['rule_name' => 'name']);
    }
}