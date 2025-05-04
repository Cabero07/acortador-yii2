<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para gestionar datos de la página intermedia.
 */
class IntermediatePage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%intermediate_pages}}';
    }

    public function rules()
    {
        return [
            [['link_id', 'views'], 'required'],
            [['link_id', 'views'], 'integer'],
        ];
    }

    public function getLink()
    {
        return $this->hasOne(Link::class, ['id' => 'link_id']);
    }
}