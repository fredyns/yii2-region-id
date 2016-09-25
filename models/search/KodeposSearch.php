<?php

namespace fredyns\daerahIndonesia\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use fredyns\daerahIndonesia\models\Kodepos;

/**
* KodeposSearch represents the model behind the search form about `fredyns\daerahIndonesia\models\Kodepos`.
*/
class KodeposSearch extends Kodepos
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'nomor', 'kelurahan_id', 'kecamatan_id', 'kota_id', 'provinsi_id'], 'integer'],
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
$query = Kodepos::find();

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
            'nomor' => $this->nomor,
            'kelurahan_id' => $this->kelurahan_id,
            'kecamatan_id' => $this->kecamatan_id,
            'kota_id' => $this->kota_id,
            'provinsi_id' => $this->provinsi_id,
        ]);

return $dataProvider;
}
}