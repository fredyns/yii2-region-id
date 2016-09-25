<?php

namespace fredyns\daerahIndonesia\controllers\api;

/**
* This is the class for REST controller "KotaController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KotaController extends \yii\rest\ActiveController
{
public $modelClass = 'fredyns\daerahIndonesia\models\Kota';
}
