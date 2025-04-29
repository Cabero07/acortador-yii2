<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `auth_item`.
 */
class AuthItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type'], 'integer'],
            [['description', 'data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'rule_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * Relación con los hijos del ítem.
     */
    public function getChildren()
    {
        return $this->hasMany(AuthItemChild::class, ['parent' => 'name']);
    }

    /**
     * Relación con los padres del ítem.
     */
    public function getParents()
    {
        return $this->hasMany(AuthItemChild::class, ['child' => 'name']);
    }

    /**
     * Relación con las reglas.
     */
    public function getRule()
    {
        return $this->hasOne(AuthRule::class, ['name' => 'rule_name']);
    }
}