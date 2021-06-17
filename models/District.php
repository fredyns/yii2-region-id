<?php

namespace fredyns\region\models;

use fredyns\region\behaviors\CityBehavior;
use fredyns\region\behaviors\ProvinceBehavior;

/**
 * This is the model class for table "region_district".
 *
 * @property integer $id
 * @property string $number
 * @property string $name
 * @property integer $city_id
 *
 * @property City $city
 * @property Subdistrict[] $subdistricts
 */
class District extends \yii\db\ActiveRecord
{
    public $province_id;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_district';
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
            'city_id' => 'City',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->province_id = $this->city->province_id;
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
            [['province_id', 'city_id', 'name'], 'required'],
            /* safe */
            /* field type */
            [
                ['province_id', 'city_id'],
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute) == FALSE);
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
        ];
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
    public function getSubdistricts()
    {
        return $this->hasMany(Subdistrict::class, ['district_id' => 'id']);
    }

}