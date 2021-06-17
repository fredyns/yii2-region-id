<?php

namespace fredyns\region\models;

use fredyns\region\behaviors\ProvinceBehavior;

/**
 * This is the model class for table "region_city".
 *
 * @property integer $id
 * @property string $number
 * @property string $name
 * @property integer $province_id
 *
 * @property Province $province
 * @property District[] $districts
 */
class City extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_city';
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
            'province_id' => 'Province',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /* auto add new name */
            [
                'class' => ProvinceBehavior::class,
                'provinceAttribute' => 'province_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['province_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Province::class,
                'targetAttribute' => ['province_id' => 'id'],
            ],
            /* filter */
            /* default value */
            /* required */
            [['province_id', 'name'], 'required'],
            /* safe */
            /* field type */
            [['number'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [
                'province_id',
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->{$attribute}) == FALSE);
                },
            ],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::class, ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::class, ['id' => 'province_id']);
    }

}