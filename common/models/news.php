<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla `news`.
 */
class News extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'created_by'], 'required'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['created_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * Relación con el autor de la noticia.
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}