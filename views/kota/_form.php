<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kota $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kota-form">

    <?php
    $form = ActiveForm::begin([
            'id'                     => 'Kota',
            'layout'                 => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass'   => 'error-summary alert alert-error'
            ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'nomor')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'singkatan')->textInput(['maxlength' => true]) ?>
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
                        'label'   => Yii::t('app', StringHelper::basename('Kota')),
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

