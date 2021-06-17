<?php

namespace fredyns\region\models;

use fredyns\region\behaviors\CityBehavior;
use fredyns\region\behaviors\DistrictBehavior;
use fredyns\region\behaviors\ProvinceBehavior;

/**
 * This is the model class for table "region_subdistrict".
 *
 * @property integer $id
 * @property string $number
 * @property string $name
 * @property integer $district_id
 *
 * @property District $district
 * @property Postcode[] $postcodes
 */
class Subdistrict extends \yii\db\ActiveRecord
{
    public $province_id;
    public $city_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_subdistrict';
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
            'district_id' => 'District',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->city_id = $this->district->city_id;
        $this->province_id = $this->district->city->province_id;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            /* auto add new name */
            [
                'class' => ProvinceBehavior::class,
                'provinceAttribute' => 'province_id',
            ],
            /* auto add new name */
            [
                'class' => CityBehavior::class,
                'provinceAttribute' => 'province_id',
                'cityAttribute' => 'city_id',
            ],
            /* auto add new name */
            [
                'class' => DistrictBehavior::class,
                'cityAttribute' => 'city_id',
                'districtAttribute' => 'district_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* filter */
            /* default */
            /* required */
            [['province_id', 'city_id', 'district_id', 'name'], 'required'],
            /* safe */
            /* field type */
            [
                ['province_id', 'city_id', 'district_id'],
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}) == FALSE);
                },
            ],
            [['number'], 'integer'],
            [['name'], 'string', 'max' => 255],
            /* restrictions */
            /* references */
            [
                ['province_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Province::class,
                'targetAttribute' => ['province_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}));
                },
            ],
            [
                ['city_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => City::class,
                'targetAttribute' => ['city_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}));
                },
            ],
            [
                ['district_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => District::class,
                'targetAttribute' => ['district_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}));
                },
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::class, ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostcodes()
    {
        return $this->hasMany(Postcode::class, ['subdistrict_id' => 'id']);
    }

}