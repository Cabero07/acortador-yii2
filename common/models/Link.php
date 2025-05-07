<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para gestionar enlaces acortados.
 */
class Link extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%links}}';
    }

    public function rules()
    {
        return [
            [['url'], 'required'], // URL obligatoria
            [['url'], 'url', 'defaultScheme' => 'http'], // Validar formato de URL
            [['short_code'], 'unique'], // Código único
            [['description'], 'string'], // Descripción opcional
        ];
    }
    /**
     * Relación con el usuario que creó el enlace.
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Relación con las estadísticas del enlace.
     */
    public function getStats()
    {
        return $this->hasOne(LinkStats::class, ['link_id' => 'id']);
    }
}
