<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\Postcode $model
 */
$this->title = Yii::t('region', 'Postcode') . ' ' . $model->number . ', ' . Yii::t('region', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Postcode'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->number;
?>
<div class="giiant-crud postcode-view">

    <h1>
        <?= Yii::t('region', 'Postcode') ?>
        <small>
            #<?= $model->id ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('region', 'Edit'),
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-info']
            )
            ?>

            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New'),
                ['create'], ['class' => 'btn btn-success']
            )
            ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'Full list'), ['index'], ['class' => 'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('Postcode'); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number',
            [
                'label' => Yii::t('region', 'Province'),
                'attribute' => 'province.name',
            ],
            [
                'label' => Yii::t('region', 'City'),
                'attribute' => 'city.name',
            ],
            [
                'label' => Yii::t('region', 'District'),
                'attribute' => 'district.name',
            ],
            [
                'label' => Yii::t('region', 'Subdistrict'),
                'attribute' => 'subdistrict.name',
            ],
        ],
    ]);
    ?>


    <hr/>

    <?=
    Html::a(
        '<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('region', 'Delete'),
        ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('region', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]
    );
    ?>
    <?php $this->endBlock(); ?>

    <?=
    Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [
            [
                'label' => '<b class=""># ' . $model->id . '</b>',
                'content' => $this->blocks['Postcode'],
                'active' => true,
            ],
        ]
    ]);
    ?>
</div>
