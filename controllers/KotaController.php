<?php

namespace fredyns\daerahIndonesia\controllers;

use fredyns\daerahIndonesia\models\Provinsi;
use fredyns\daerahIndonesia\models\Kota;
use fredyns\daerahIndonesia\models\Kecamatan;
use fredyns\daerahIndonesia\models\Kelurahan;

/**
 * This is the class for controller "KotaController".
 */
class KotaController extends \fredyns\daerahIndonesia\controllers\base\KotaController
{

    /**
     * menyediakan data untuk depdrop
     * @param integer $selected
     *
     * @return mixed
     */
    public function actionDepdropOptions($selected = 0)
    {
        echo \fredyns\daerahIndonesia\helpers\DepdropHelper::getOptionData([
            'modelClass' => Provinsi::className(),
            'parents' => [
                'provinsi_id' => function($value) {
                    return ($value > 0) ? $value : "";
                },
            ],
            'selected' => $selected,
        ]);
    }
}