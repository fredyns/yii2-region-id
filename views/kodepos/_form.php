<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kodepos $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kodepos-form">

    <?php
    $form = ActiveForm::begin([
            'id'                     => 'Kodepos',
            'layout'                 => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass'   => 'error-summary alert alert-error'
            ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'nomor')->textInput() ?>
            <?=
            $form->field($model, 'kelurahan_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(fredyns\daerahIndonesia\models\Kelurahan::find()->all(), 'id', 'id'),
                ['prompt' => 'Select']
            );
            ?>
            <?=
            $form->field($model, 'kecamatan_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(fredyns\daerahIndonesia\models\Kecamatan::find()->all(), 'id', 'id'),
                ['prompt' => 'Select']
            );
            ?>
            <?=
            $form->field($model, 'kota_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(fredyns\daerahIndonesia\models\Kota::find()->all(), 'id', 'id'),
                ['prompt' => 'Select']
            );
            ?>
            <?=
            $form->field($model, 'provinsi_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(fredyns\daerahIndonesia\models\Provinsi::find()->all(), 'id', 'id'),
                ['prompt' => 'Select']
            );
            ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items'        => [
                    [
                        'label'   => Yii::t('app', StringHelper::basename('fredyns\daerahIndonesia\models\Kodepos')),
                        'content' => $this->blocks['main'],
                        'active'  => true,
                    ],
                ]
            ]
        );
        ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?=
        Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> '.
            ($model->isNewRecord ? 'Create' : 'Save'),
            [
            'id'    => 'save-'.$model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

