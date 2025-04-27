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
            [['url'], 'required'],
            [['url'], 'url', 'defaultScheme' => 'http'], // Permitir URLs sin esquema
            [['short_code'], 'unique'], // Asegurar que el código sea único
        ];
    }
    public function getStats()
    {
        return $this->hasOne(LinkStats::class, ['link_id' => 'id']);
    }
}
