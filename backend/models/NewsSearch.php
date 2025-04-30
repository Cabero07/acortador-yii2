<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\News;

class NewsSearch extends News
{
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['title', 'created_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // Si la validación falla, no devolver ningún resultado
            $query->where('0=1');
            return $dataProvider;
        }

        // Filtros
        $query->andFilterWhere(['id' => $this->id])
              ->andFilterWhere(['created_by' => $this->created_by])
              ->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}