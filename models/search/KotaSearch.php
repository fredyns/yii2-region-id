<?php

namespace fredyns\daerahIndonesia\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use fredyns\daerahIndonesia\models\Kota;

/**
 * KotaSearch represents the model behind the search form about `fredyns\daerahIndonesia\models\Kota`.
 */
class KotaSearch extends Kota
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'provinsi_id'], 'integer'],
            [['nomor', 'nama', 'singkatan'], 'safe'],
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
        $query = Kota::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'provinsi_id' => $this->provinsi_id,
        ]);

        $query
            ->andFilterWhere(['like', 'nomor', $this->nomor])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'singkatan', $this->singkatan]);

        return $dataProvider;
    }
}