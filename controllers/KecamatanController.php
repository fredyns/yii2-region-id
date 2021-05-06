<?php

namespace fredyns\daerahIndonesia\controllers;

use fredyns\daerahIndonesia\models\Kecamatan;
use yii\web\Response;

/**
 * This is the class for controller "KecamatanController".
 */
class KecamatanController extends \fredyns\daerahIndonesia\controllers\base\KecamatanController
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
            'modelClass' => Kecamatan::className(),
            'idField' => 'id',
            'nameField' => 'nama',
            'parents' => [
                'kota_id' => function($value) {
                    return ($value > 0) ? $value : "";
                },
            ],
            'selected' => $selected,
        ]);
    }
}