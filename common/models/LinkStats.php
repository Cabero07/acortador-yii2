<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para gestionar estadísticas de enlaces.
 */
class LinkStats extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%link_stats}}';
    }

    public function rules()
    {
        return [
            [['link_id', 'clicks', 'earnings'], 'required'],
            [['link_id', 'clicks'], 'integer'],
            [['earnings'], 'number'],
        ];
    }

    public function getLink()
    {
        return $this->hasOne(Link::class, ['id' => 'link_id']);
    }
}