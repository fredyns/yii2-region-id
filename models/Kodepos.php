<?php

namespace fredyns\daerahIndonesia\models;

use Yii;
use \fredyns\daerahIndonesia\models\base\Kodepos as BaseKodepos;
use fredyns\daerahIndonesia\models\Provinsi;
use fredyns\daerahIndonesia\models\Kota;
use fredyns\daerahIndonesia\models\Kecamatan;
use fredyns\daerahIndonesia\models\Kelurahan;
use fredyns\daerahIndonesia\behaviors\ProvinsiBehavior;
use fredyns\daerahIndonesia\behaviors\KotaBehavior;
use fredyns\daerahIndonesia\behaviors\KecamatanBehavior;
use fredyns\daerahIndonesia\behaviors\KelurahanBehavior;

/**
 * This is the model class for table "_kodepos".
 */
class Kodepos extends BaseKodepos
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
            [['provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id', 'nomor'], 'required'],
            /* safe */
            /* field type */
            [
                ['provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id'],
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute) == FALSE);
                },
            ],
            [['nomor'], 'integer'],
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
            [
                ['kota_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Kota::className(),
                'targetAttribute' => ['kota_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute));
                },
                'message' => "Kota belum tardaftar.",
            ],
            [
                ['kecamatan_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Kecamatan::className(),
                'targetAttribute' => ['kecamatan_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute));
                },
                'message' => "Kecamatan belum tardaftar.",
            ],
            [
                ['kelurahan_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Kelurahan::className(),
                'targetAttribute' => ['kelurahan_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute));
                },
                'message' => "Kelurahan belum tardaftar.",
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
            /* otomatis menambahkan kota baru */
            [
                'class' => KotaBehavior::className(),
                'provinsiAttribute' => 'provinsi_id',
                'kotaAttribute' => 'kota_id',
            ],
            /* otomatis menambahkan kecamatan baru */
            [
                'class' => KecamatanBehavior::className(),
                'kotaAttribute' => 'kota_id',
                'kecamatanAttribute' => 'kecamatan_id',
            ],
            /* otomatis menambahkan kelurahan baru */
            [
                'class' => KelurahanBehavior::className(),
                'kecamatanAttribute' => 'kecamatan_id',
                'kelurahanAttribute' => 'kelurahan_id',
            ],
        ];
    }
}