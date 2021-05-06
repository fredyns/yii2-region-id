<?php

namespace fredyns\daerahIndonesia\controllers;

use fredyns\daerahIndonesia\models\Kota;
use yii\web\Response;

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
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return \fredyns\daerahIndonesia\helpers\DepdropHelper::getOptionData([
            'modelClass' => Kota::className(),
            'idField' => 'id',
            'nameField' => 'nama',
            'parents' => [
                'provinsi_id' => function ($value) {
                    return ($value > 0) ? $value : "";
                },
            ],
            'selected' => $selected,
        ]);
    }
}