<?php

use yii\bootstrap\Tabs;
use fredyns\region\models\Province;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\City $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="city-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'City',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('region', 'City'),
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
            '<span class="glyphicon glyphicon-check"></span> ' .
            ($model->isNewRecord ? Yii::t('region', 'Create') : Yii::t('region', 'Save')),
            ['id' => 'save-' . $model->formName(), 'class' => 'btn btn-success']
        );
        ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

