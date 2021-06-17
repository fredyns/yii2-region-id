<?php

namespace fredyns\region\models\search;

use fredyns\region\models\Province;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProvinceSearch represents the model behind the search form about `fredyns\region\models\Province`.
 */
class ProvinceSearch extends Province
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Province::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'number' => $this->number,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}