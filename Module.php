<?php

namespace fredyns\daerahIndonesia;

use dmstr\web\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'fredyns\daerahIndonesia\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
