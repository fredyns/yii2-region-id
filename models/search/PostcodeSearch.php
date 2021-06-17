<?php

namespace fredyns\region\models\search;

use fredyns\region\models\Postcode;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PostcodeSearch represents the model behind the search form about `fredyns\region\models\Postcode`.
 */
class PostcodeSearch extends Postcode
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'subdistrict_id'], 'integer'],
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
        $query = Postcode::find()
            ->with('subdistrict', 'subdistrict.district', 'subdistrict.district.city');

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
            'subdistrict_id' => $this->subdistrict_id,
        ]);

        return $dataProvider;
    }
}