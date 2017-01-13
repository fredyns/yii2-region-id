<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\bootstrap\ActiveForm;
use dmstr\bootstrap\Tabs;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use fredyns\daerahIndonesia\models\Provinsi;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kecamatan $model
 * @var yii\widgets\ActiveForm $form
 */
$moduleId = Yii::$app->controller->module->id;
?>

<div class="kecamatan-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'Kecamatan',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
            ]
    );
    ?>

    <div class="">

        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'nomor')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

            <?=
                $form
                ->field($model, 'kota_id')
                ->widget(DepDrop::classname(),
                    [
                    'data' => [],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => [
                        'pluginOptions' => [
                            'multiple' => FALSE,
                            'allowClear' => TRUE,
                            'tags' => TRUE,
                            'maximumInputLength' => 255,
                        ],
                    ],
                    'pluginOptions' => [
                        'initialize' => TRUE,
                        'placeholder' => 'Pilih atau ketik nama Kota',
                        'depends' => ['kecamatan-provinsi_id'],
                        'url' => Url::to([
                            "/{$moduleId}/kota/depdrop-options",
                            'selected' => $model->kota_id,
                        ]),
                        'loadingText' => 'Memuat Kota ...',
                    ],
            ]);
            ?>

            <?=
                $form
                ->field($model, 'provinsi_id')
                ->widget(Select2::classname(),
                    [
                    'data' => Provinsi::options(),
                    'pluginOptions' =>
                    [
                        'placeholder' => 'Pilih atau ketik nama Provinsi',
                        'multiple' => FALSE,
                        'allowClear' => TRUE,
                        'tags' => TRUE,
                        'maximumInputLength' => 255, /* country name maxlength */
                    ],
            ]);
            ?>

        </p>

        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('app', StringHelper::basename('Kecamatan')),
                        'content' => $this->blocks['main'],
                        'active' => true,
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
            'id' => 'save-'.$model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

