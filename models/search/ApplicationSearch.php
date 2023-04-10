<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Application;

/**
 * ApplicationSearch represents the model behind the search form of `app\models\Application`.
 */
class ApplicationSearch extends Application
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'is_first', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sender_first_name', 'sender_last_name', 'owners', 'article_name', 'comment', 'phone', 'email', 'link'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Application::find()->orderBy(['created_at' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'is_first' => $this->is_first,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'sender_first_name', $this->sender_first_name])
            ->andFilterWhere(['like', 'sender_last_name', $this->sender_last_name])
            ->andFilterWhere(['like', 'owners', $this->owners])
            ->andFilterWhere(['like', 'article_name', $this->article_name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
