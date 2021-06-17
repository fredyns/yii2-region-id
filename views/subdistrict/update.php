<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\Subdistrict $model
 */
$this->title = Yii::t('region', 'Subdistrict') . ' #' . $model->id . ', ' . Yii::t('region', 'Edit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Subdistrict'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('region', 'Edit');
?>
<div class="giiant-crud subdistrict-update">

    <h1>
        <?= Yii::t('region', 'Subdistrict') ?>
        <small>
            #<?= $model->id ?>
        </small>
    </h1>

    <div class="crud-navigation">
        <?=
        Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('region', 'View'),
            ['view', 'id' => $model->id],
            ['class' => 'btn btn-default']
        )
        ?>
    </div>

    <hr/>

    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
