<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\News;

class NewsSearch extends News
{
    public $author; // Campo adicional para buscar por username

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'created_at', 'author'], 'safe'], // Agregar 'author' como campo seguro
        ];
    }

    public function search($params)
    {
        $query = News::find()->joinWith('author'); // Unir la tabla de usuarios

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // Si la validación falla, devolver un resultado vacío
            $query->where('0=1');
            return $dataProvider;
        }

        // Filtros aplicados
        $query->andFilterWhere(['id' => $this->id])
              ->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 'created_at', $this->created_at])
              ->andFilterWhere(['like', 'user.username', $this->author]); // Filtro por username

        return $dataProvider;
    }
}