<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\bootstrap\ActiveForm;
use dmstr\bootstrap\Tabs;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use fredyns\daerahIndonesia\models\Provinsi;

$model = new \fredyns\daerahIndonesia\models\Kodepos;
$this->title = Yii::t('app', 'Daerah Indonesia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daerah Indonesia'), 'url' => ['/'.\Yii::$app->controller->module->id]];
?>
<div class="daerahIndonesia-default-index">

    <h1>Daerah Indonesia</h1>

    <p>
        Berisi data seluruh wilayah Indonesia sesuai Permendagri No 39 tahun 2015.

        <?=
        Html::ol(
            [
            Html::a('Provinsi', ['provinsi/index']),
            Html::a('Kota', ['kota/index']),
            Html::a('Kecamatan', ['kecamatan/index']),
            Html::a('Kelurahan', ['kelurahan/index']),
            Html::a('Kodepos', ['kodepos/index']),
            ], [
            'encode' => false,
            ]
        );
        ?>
    </p>

    <h3>Contoh Formulir</h3>

    <div class="sample-form">

        <?php
        $form = ActiveForm::begin([
                'id' => 'Sample',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error'
                ]
        );
        ?>

        <p>

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
                        'depends' => ['kodepos-provinsi_id'],
                        'url' => Url::to([
                            "kota/depdrop-options",
                            'selected' => $model->kota_id,
                        ]),
                        'loadingText' => 'Memuat Kota ...',
                    ],
            ]);
            ?>

            <?=
                $form
                ->field($model, 'kecamatan_id')
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
                        'placeholder' => 'Pilih atau ketik nama Kecamatan',
                        'depends' => ['kodepos-kota_id'],
                        'url' => Url::to([
                            "kecamatan/depdrop-options",
                            'selected' => $model->kecamatan_id,
                        ]),
                        'loadingText' => 'Memuat Kecamatan ...',
                    ],
            ]);
            ?>

            <?=
                $form
                ->field($model, 'kelurahan_id')
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
                        'placeholder' => 'Pilih atau ketik nama Kelurahan',
                        'depends' => ['kodepos-kecamatan_id'],
                        'url' => Url::to([
                            "kelurahan/depdrop-options",
                            'selected' => $model->kelurahan_id,
                        ]),
                        'loadingText' => 'Memuat Kelurahan ...',
                    ],
            ]);
            ?>

        </p>

        <i>*contoh penerapannya lihat pada formulir kodepos</i>

        <?php ActiveForm::end(); ?>

    </div>


</div>
