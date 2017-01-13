<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\search\KelurahanSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kelurahan-search">

    <?php
    $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'nomor') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'kecamatan_id')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
