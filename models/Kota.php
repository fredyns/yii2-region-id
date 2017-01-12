<?php

namespace fredyns\daerahIndonesia\models;

use Yii;
use fredyns\daerahIndonesia\models\base\Kota as BaseKota;
use fredyns\daerahIndonesia\models\Provinsi;
use fredyns\daerahIndonesia\behaviors\ProvinsiBehavior;

/**
 * This is the model class for table "_kota".
 */
class Kota extends BaseKota
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* filter */
            /* default value */
            /* required */
            [['provinsi_id', 'nama'], 'required'],
            /* safe */
            /* field type */
            [
                'provinsi_id',
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute) == FALSE);
                },
            ],
            [['nomor'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 255],
            [['singkatan'], 'string', 'max' => 64],
            /* value limitation */
            /* value references */
            [
                ['provinsi_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Provinsi::className(),
                'targetAttribute' => ['provinsi_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute));
                },
                'message' => "Provinsi belum tardaftar.",
            ],
        ];
    }

    /**
     * Form behavior ketika input data
     * ketika memasukan nama baru akan ditambahkan ke dalam database
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            /* otomatis menambahkan provinsi baru */
            [
                'class' => ProvinsiBehavior::className(),
                'provinsiAttribute' => 'provinsi_id',
            ],
        ];
    }
}