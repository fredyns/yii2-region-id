<?php

namespace fredyns\daerahIndonesia\controllers\api;

/**
* This is the class for REST controller "KecamatanController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KecamatanController extends \yii\rest\ActiveController
{
public $modelClass = 'fredyns\daerahIndonesia\models\Kecamatan';
}
