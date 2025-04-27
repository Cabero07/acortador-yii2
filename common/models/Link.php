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
            [['url', 'short_code'], 'required'],
            [['url'], 'string'],
            [['short_code'], 'string', 'max' => 50],
            [['short_code'], 'unique'],
        ];
    }

    public function getStats()
    {
        return $this->hasOne(LinkStats::class, ['link_id' => 'id']);
    }
}