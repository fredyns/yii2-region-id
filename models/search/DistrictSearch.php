<?php

namespace fredyns\region\models\search;

use fredyns\region\models\District;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DistrictSearch represents the model behind the search form about `fredyns\region\models\District`.
 */
class DistrictSearch extends District
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'city_id'], 'integer'],
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
        $query = District::find()->with('city');

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
            'city_id' => $this->city_id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}