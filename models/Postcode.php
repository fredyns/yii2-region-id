<?php

namespace fredyns\region\models;

use fredyns\region\behaviors\CityBehavior;
use fredyns\region\behaviors\DistrictBehavior;
use fredyns\region\behaviors\ProvinceBehavior;
use fredyns\region\behaviors\SubdistrictBehavior;

/**
 * This is the model class for table "region_postcode".
 *
 * @property integer $id
 * @property integer $number
 * @property integer $subdistrict_id
 *
 * @property Subdistrict $subdistrict
 * @property District $district
 * @property City $city
 * @property Province $province
 */
class Postcode extends \yii\db\ActiveRecord
{
    public $province_id;
    public $city_id;
    public $district_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_postcode';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'subdistrict_id' => 'Subdistrict',
            'district_id' => 'District',
            'city_id' => 'City',
            'province_id' => 'Province',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();

        if (empty($this->subdistrict)) {
            return;
        }
        $this->district_id = $this->subdistrict->district_id;

        if (empty($this->subdistrict->district)) {
            return;
        }
        $this->city_id = $this->subdistrict->district->city_id;

        if (empty($this->subdistrict->district->city)) {
            return;
        }
        $this->province_id = $this->subdistrict->district->city->province_id;
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
            /* auto add new name */
            [
                'class' => SubdistrictBehavior::class,
                'districtAttribute' => 'district_id',
                'subdistrictAttribute' => 'subdistrict_id',
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
            [['province_id', 'city_id', 'district_id', 'subdistrict_id', 'number'], 'required'],
            /* safe */
            /* field type */
            [
                ['province_id', 'city_id', 'district_id', 'subdistrict_id'],
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}) == FALSE);
                },
            ],
            [['number'], 'integer'],
            /* value limitation */
            /* value references */
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
                'message' => "District belum tardaftar.",
            ],
            [
                ['subdistrict_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Subdistrict::class,
                'targetAttribute' => ['subdistrict_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}));
                },
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubdistrict()
    {
        return $this->hasOne(Subdistrict::class, ['id' => 'subdistrict_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Subdistrict::class, ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::class, ['id' => 'province_id']);
    }


}