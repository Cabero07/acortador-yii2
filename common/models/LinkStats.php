<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `link_stats`.
 *
 * @property int $id
 * @property int $link_id
 * @property int $clicks
 * @property string $created_at
 * @property string $updated_at
 */
class LinkStats extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_stats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_id', 'clicks'], 'required'],
            [['link_id', 'clicks'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['link_id'], 'exist', 'skipOnError' => true, 'targetClass' => Link::class, 'targetAttribute' => ['link_id' => 'id']],
        ];
    }

    /**
     * Relación con la tabla `links`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLink()
    {
        return $this->hasOne(Link::class, ['id' => 'link_id']);
    }
}