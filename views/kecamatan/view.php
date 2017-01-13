<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kecamatan $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'Kecamatan').' #'.$model->id.', '.'View';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daerah Indonesia'), 'url' => ['/'.\Yii::$app->controller->module->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kecamatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud kecamatan-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'Kecamatan') ?>
        <small>
            #<?= $model->id ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> '.'Edit', ['update', 'id' => $model->id],
                ['class' => 'btn btn-info'])
            ?>

            <?=
            Html::a(
                '<span class="glyphicon glyphicon-copy"></span> '.'Copy',
                ['create', 'id' => $model->id, 'Kecamatan' => $copyParams], ['class' => 'btn btn-success'])
            ?>

            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.'New', ['create'], ['class' => 'btn btn-success'])
            ?>
        </div>

        <div class="pull-right">
            <?=
            Html::a('<span class="glyphicon glyphicon-list"></span> '
                .'Full list', ['index'], ['class' => 'btn btn-default'])
            ?>
        </div>

    </div>

    <hr />

    <?php $this->beginBlock('Kecamatan'); ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor',
            'nama',
            [
                'label' => 'Kota',
                'attribute' => 'kota.nama',
            ],
            [
                'label' => 'Provinsi',
                'attribute' => 'kota.provinsi.nama',
            ],
        ],
    ]);
    ?>


    <hr/>

    <?=
    Html::a('<span class="glyphicon glyphicon-trash"></span> '.'Delete', ['delete', 'id' => $model->id],
        [
        'class' => 'btn btn-danger',
        'data-confirm' => ''.'Are you sure to delete this item?'.'',
        'data-method' => 'post',
    ]);
    ?>
    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('Kelurahan'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> '.'List All'.' Kelurahan', ['kelurahan/index'],
                ['class' => 'btn text-muted btn-xs']
            )
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.'New'.' Kelurahan',
                ['kelurahan/create', 'Kelurahan' => ['kecamatan_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjax-Kelurahan',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-Kelurahans ul.pagination a, th a',
        'clientOptions' => ['pjax:success' => 'function(){alert("yo")}',
        ],
    ])
    ?>
    <?=
    '<div class="table-responsive">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getKelurahans(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-kelurahan',
            ],
            ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'kelurahan'.'/'.$action;
                    return $params;
                },
                'buttons' => [
                ],
                'controller' => 'kelurahan'
            ],
            'nomor',
            'nama',
        ]
    ])
    .'</div>'
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
                    'label' => '<b class=""># '.$model->id.'</b>',
                    'content' => $this->blocks['Kecamatan'],
                    'active' => true,
                ],
                [
                    'content' => $this->blocks['Kelurahan'],
                    'label' => '<small>Kelurahans <span class="badge badge-default">'.$model->getKelurahans()->count().'</span></small>',
                    'active' => false,
                ],
            ],
        ]
    );
    ?>
</div>
