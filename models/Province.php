<?php

namespace fredyns\region\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "region_province".
 *
 * @property integer $id
 * @property string $number
 * @property string $name
 *
 * @property City[] $cities
 */
class Province extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_province';
    }

    /**
     * form option data
     *
     * @return array
     */
    static function options()
    {
        $query = static::find()
            ->orderBy(['name' => SORT_ASC])
            ->all();

        return ArrayHelper::map($query, 'id', 'name');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['number'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['province_id' => 'id']);
    }

}