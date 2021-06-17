<?php

use fredyns\region\models\Province;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\Subdistrict $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="subdistrict-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'Subdistrict',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]);
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?=
            $form
                ->field($model, 'district_id')
                ->widget(DepDrop::class,
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
                            'placeholder' => Yii::t('region', 'select or type new district'),
                            'depends' => ['subdistrict-city_id'],
                            'url' => Url::to([
                                "/region/district/depdrop-options",
                                'selected' => $model->district_id,
                            ]),
                            'loadingText' => Yii::t('region', 'loading districts...'),
                        ],
                    ]);
            ?>

            <?=
            $form
                ->field($model, 'city_id')
                ->widget(DepDrop::class,
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
                            'placeholder' => Yii::t('region', 'select or type new city'),
                            'depends' => ['subdistrict-province_id'],
                            'url' => Url::to([
                                "/region/city/depdrop-options",
                                'selected' => $model->city_id,
                            ]),
                            'loadingText' => Yii::t('region', 'loading cities...'),
                        ],
                    ]);
            ?>

            <?=
            $form
                ->field($model, 'province_id')
                ->widget(Select2::class,
                    [
                        'data' => Province::options(),
                        'pluginOptions' =>
                            [
                                'placeholder' => Yii::t('region', 'select or type new province'),
                                'multiple' => FALSE,
                                'allowClear' => TRUE,
                                'tags' => TRUE,
                                'maximumInputLength' => 255,
                            ],
                    ]);
            ?>

        </p>

        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => Yii::t('region', 'Subdistrict'),
                    'content' => $this->blocks['main'],
                    'active' => true,
                ],
            ]
        ]);
        ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?=
        Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' .
            ($model->isNewRecord ? Yii::t('region', 'Create') : Yii::t('region', 'Save')),
            [
                'id' => 'save-' . $model->formName(),
                'class' => 'btn btn-success'
            ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

