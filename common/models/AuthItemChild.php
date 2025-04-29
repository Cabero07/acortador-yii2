<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `auth_item_child`.
 */
class AuthItemChild extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item_child}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
        ];
    }

    /**
     * Relación con el ítem padre.
     */
    public function getParentItem()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'parent']);
    }

    /**
     * Relación con el ítem hijo.
     */
    public function getChildItem()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'child']);
    }
}