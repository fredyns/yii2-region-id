<?php

namespace fredyns\daerahIndonesia\controllers;

use fredyns\daerahIndonesia\models\Kelurahan;

/**
 * This is the class for controller "KelurahanController".
 */
class KelurahanController extends \fredyns\daerahIndonesia\controllers\base\KelurahanController
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
            'modelClass' => Kelurahan::className(),
            'idField' => 'id',
            'nameField' => 'nama',
            'parents' => [
                'provinsi_id' => function($value) {
                    return ($value > 0) ? $value : "";
                },
            ],
            'selected' => $selected,
        ]);
    }
}