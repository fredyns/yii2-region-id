<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\Subdistrict $model
 */
$this->title = Yii::t('region', 'Subdistrict') . ' #' . $model->id . ', ' . Yii::t('region', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Subdistrict'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;
?>
<div class="giiant-crud subdistrict-view">

    <h1>
        <?= Yii::t('region', 'Subdistrict') ?>
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
                ['create'],
                ['class' => 'btn btn-success']
            )
            ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'Full list'), ['index'], ['class' => 'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('Subdistrict'); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number',
            'name',
            [
                'label' => 'District',
                'attribute' => 'district.name',
            ],
            [
                'label' => Yii::t('region', 'City'),
                'attribute' => 'district.city.name',
            ],
            [
                'label' => Yii::t('region', 'Province'),
                'attribute' => 'district.city.province.name',
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

    <?php $this->beginBlock('Postcode'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'List All') . ' ' . Yii::t('region', 'Postcodes'),
                ['postcode/index'],
                ['class' => 'btn text-muted btn-xs']
            )
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New') . ' ' . Yii::t('region', 'Postcode'),
                ['postcode/create', 'Postcode' => ['subdistrict_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjax-Postcode',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-Postcode ul.pagination a, th a',
        'clientOptions' => ['pjax:success' => 'function(){alert("yo")}'],
    ])
    ?>
    <?=
    '<div class="table-responsive">'
    . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getPostcodes(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-postcode',
            ],
        ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::class,
            'firstPageLabel' => Yii::t('region', 'First'),
            'lastPageLabel' => Yii::t('region', 'Last'),
        ],
        'columns' => [
            'number',
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => "{update} {delete}",
                'urlCreator' => function ($action, $model, $key, $index) {
                    return ["/region/postcode/{$action}", 'id' => $model->id];
                },
            ],
        ],
    ])
    . '</div>'
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?=
    Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => '<b class=""># ' . $model->id . '</b>',
                    'content' => $this->blocks['Subdistrict'],
                    'active' => true,
                ],
                [
                    'content' => $this->blocks['Postcode'],
                    'label' => '<small>Postcode <span class="badge badge-default">' . $model->getPostcodes()->count() . '</span></small>',
                    'active' => false,
                ],
            ]
        ]
    );
    ?>
</div>
