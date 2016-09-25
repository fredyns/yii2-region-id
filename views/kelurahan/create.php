<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var fredyns\daerahIndonesia\models\Kelurahan $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kelurahans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud kelurahan-create">

    <h1>
        <?= Yii::t('app', 'Kelurahan') ?>        <small>
                        <?= $model->id ?>        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            'Cancel',
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
