<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kota $model
 */
$this->title                   = 'Create';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daerah Indonesia'), 'url' => ['/'.\Yii::$app->controller->module->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kotas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud kota-create">

    <h1>
        <?= Yii::t('app', 'Kota') ?>
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
