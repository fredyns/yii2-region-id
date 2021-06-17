<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\City $model
 */
$this->title = Yii::t('region', 'City') . ' #' . $model->id . ', ' . Yii::t('region', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'City'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;
?>
<div class="giiant-crud city-view">

    <h1>
        <?= Yii::t('region', 'City') ?>
        <small>
            #<?= $model->id ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('region', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'Full list'), ['index'], ['class' => 'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('City'); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'name',
            [
                'label' => Yii::t('region', 'Province'),
                'attribute' => 'province.name',
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

    <?php $this->beginBlock('District'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('region', 'List All') . ' ' . Yii::t('region', 'District'), ['district/index'],
                ['class' => 'btn text-muted btn-xs']
            )
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New') . ' ' . Yii::t('region', 'District'),
                ['district/create', 'District' => ['city_id' => $model->id]], ['class' => 'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjax-District',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-Districts ul.pagination a, th a',
        'clientOptions' => ['pjax:success' => 'function(){alert("yo")}'],
    ])
    ?>
    <?=
    '<div class="table-responsive">'
    . \yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getDistricts(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-district',
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
                'template' => '{view}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    return ["/region/district/{$action}", 'id' => $model->id];
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
                    'content' => $this->blocks['City'],
                    'active' => true,
                ],
                [
                    'content' => $this->blocks['District'],
                    'label' => '<small>Districts <span class="badge badge-default">' . $model->getDistricts()->count() . '</span></small>',
                    'active' => false,
                ],
            ]
        ]
    );
    ?>
</div>
