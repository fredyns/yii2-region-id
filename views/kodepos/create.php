<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kodepos $model
 */
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daerah Indonesia'), 'url' => ['/'.\Yii::$app->controller->module->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kodepos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud kodepos-create">

    <h1>
        <?= Yii::t('app', 'Kodepos') ?>
        <small>
            baru
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=
            Html::a(
                'Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default'])
            ?>
        </div>
    </div>

    <hr />

    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
