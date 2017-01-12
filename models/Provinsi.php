<?php

namespace fredyns\daerahIndonesia\models;

use Yii;
use yii\helpers\ArrayHelper;
use fredyns\daerahIndonesia\models\base\Provinsi as BaseProvinsi;

/**
 * This is the model class for table "_provinsi".
 */
class Provinsi extends BaseProvinsi
{

    /**
     * data untuk opsi formulir
     *
     * @return array
     */
    static function options()
    {
        $query = static::find()
            ->orderBy(['nama' => SORT_ASC])
            ->all();

        return ArrayHelper::map($query, 'id', 'nama');
    }
}