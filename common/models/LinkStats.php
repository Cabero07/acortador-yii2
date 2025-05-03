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

    public function getClicksGroupedByDay($userId)
    {
        return self::find()
            ->alias('ls')
            ->select(['DATE(ls.created_at) as day', 'SUM(ls.clicks) as total_clicks', 'l.id as link_id', 'l.url as link_url'])
            ->leftJoin('links l', 'l.id = ls.link_id')
            ->where(['l.user_id' => $userId])
            ->groupBy(['DATE(ls.created_at)', 'l.id'])
            ->orderBy(['day' => SORT_DESC])
            ->asArray()
            ->all();
    }
    public function getLink()
    {
        return $this->hasOne(Link::class, ['id' => 'link_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
