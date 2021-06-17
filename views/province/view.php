<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\Province $model
 */
$this->title = Yii::t('region', 'Province') . ' #' . $model->id . ', ' . Yii::t('region', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/' . \Yii::$app->controller->module->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Province'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;
?>
<div class="giiant-crud province-view">

    <h1>
        <?= Yii::t('region', 'Province') ?>
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
                ['class' => 'btn btn-info'])
            ?>

            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New'),
                ['create'], ['class' => 'btn btn-success'])
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

    <?php $this->beginBlock('Province'); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number',
            'name',
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

    <?php $this->beginBlock('City'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'List All') . ' ' . Yii::t('region', 'City'),
                ['/region/city/index'],
                ['class' => 'btn text-muted btn-xs']
            )
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New') . ' ' . Yii::t('region', 'City'),
                ['/region/city/create', 'City' => ['province_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjax-City',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-Cities ul.pagination a, th a',
        'clientOptions' => ['pjax:success' => 'function(){alert("yo")}',
        ],
    ])
    ?>
    <?=
    '<div class="table-responsive">'
    . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getCities(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-city',
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
                'class' => \yii\grid\ActionColumn::class,
                'options' => [],
                'template' => "{view}",
                'urlCreator' => function ($action, $model, $key, $index) {
                    return ["/region/city/{$action}", 'id' => $model->id];
                },
                'contentOptions' => ['nowrap' => 'nowrap'],
            ],
        ]
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
                    'content' => $this->blocks['Province'],
                    'active' => true,
                ],
                [
                    'content' => $this->blocks['City'],
                    'label' => '<small>Cities <span class="badge badge-default">' . $model->getCities()->count() . '</span></small>',
                    'active' => false,
                ],
            ]
        ]
    );
    ?>
</div>
