<?php

namespace fredyns\daerahIndonesia\controllers\api;

/**
* This is the class for REST controller "KelurahanController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KelurahanController extends \yii\rest\ActiveController
{
public $modelClass = 'fredyns\daerahIndonesia\models\Kelurahan';
}
