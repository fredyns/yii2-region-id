<?php

namespace fredyns\daerahIndonesia\models;

use Yii;
use fredyns\daerahIndonesia\models\base\Kelurahan as BaseKelurahan;
use fredyns\daerahIndonesia\models\Provinsi;
use fredyns\daerahIndonesia\models\Kota;
use fredyns\daerahIndonesia\models\Kecamatan;
use fredyns\daerahIndonesia\behaviors\ProvinsiBehavior;
use fredyns\daerahIndonesia\behaviors\KotaBehavior;
use fredyns\daerahIndonesia\behaviors\KecamatanBehavior;

/**
 * This is the model class for table "_kelurahan".
 */
class Kelurahan extends BaseKelurahan
{
    public $provinsi_id;
    public $kota_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* filter */
            /* default value */
            /* required */
            [['provinsi_id', 'kota_id', 'kecamatan_id', 'nama'], 'required'],
            /* safe */
            /* field type */
            [
                ['provinsi_id', 'kota_id', 'kecamatan_id'],
                'string',
                'max' => 255,
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute) == FALSE);
                },
            ],
            [['nomor'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 255],
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
        ];
    }
}