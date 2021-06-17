<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\District $model
 */
$this->title = Yii::t('region', 'District') . ' #' . $model->id . ', ' . Yii::t('region', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'District'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;
?>
<div class="giiant-crud district-view">

    <h1>
        <?= Yii::t('region', 'District') ?>
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
            <?=
            Html::a('<span class="glyphicon glyphicon-list"></span> '
                . Yii::t('region', 'Full list'), ['index'], ['class' => 'btn btn-default'])
            ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('District'); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'name',
            [
                'label' => Yii::t('region', 'City'),
                'attribute' => 'city.name',
            ],
            [
                'label' => Yii::t('region', 'Province'),
                'attribute' => 'city.province.name',
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

    <?php $this->beginBlock('Subdistrict'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'List All') . Yii::t('region', 'Subdistrict'),
                ['subdistrict/index'],
                ['class' => 'btn text-muted btn-xs']
            )
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New') . Yii::t('region', 'Subdistrict'),
                ['subdistrict/create', 'Subdistrict' => ['district_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjax-Subdistrict',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-Subdistricts ul.pagination a, th a',
        'clientOptions' => ['pjax:success' => 'function(){alert("yo")}',
        ],
    ])
    ?>
    <?=
    '<div class="table-responsive">'
    . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getSubdistricts(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-subdistrict',
            ],
        ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::class,
            'firstPageLabel' => Yii::t('region', 'First'),
            'lastPageLabel' => Yii::t('region', 'Last'),
        ],
        'columns' => [
            [
                'class' => \yii\grid\SerialColumn::class,
            ],
            'number',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    return ["/region/subdistrict/{$action}", 'id' => $model->id];
                },
                'buttons' => [
                ],
                'controller' => 'subdistrict'
            ],
        ],
    ])
    . '</div>'
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>

    <?=
    Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [
            [
                'label' => '<b class=""># ' . $model->id . '</b>',
                'content' => $this->blocks['District'],
                'active' => true,
            ],
            [
                'content' => $this->blocks['Subdistrict'],
                'label' => '<small>Subdistricts <span class="badge badge-default">' . $model->getSubdistricts()->count() . '</span></small>',
                'active' => false,
            ],
        ],
    ]);
    ?>
</div>
