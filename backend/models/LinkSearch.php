<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class LinkSearch extends Link
{
    public function rules()
    {
        return [
            [['short_code', 'url', 'title', 'description'], 'safe'],
            [['is_active', 'user_id'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = Link::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}