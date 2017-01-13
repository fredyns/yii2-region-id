<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var fredyns\daerahIndonesia\models\Kota $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'Kota').' #'.$model->id.', '.'View';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daerah Indonesia'), 'url' => ['/'.\Yii::$app->controller->module->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kota'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud kota-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Yii::t('app', 'Kota') ?>
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
                ['create', 'id' => $model->id, 'Kota' => $copyParams], ['class' => 'btn btn-success'])
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

    <?php $this->beginBlock('Kota'); ?>


    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor',
            'nama',
            'singkatan',
            [
                'label' => 'Provinsi',
                'attribute' => 'provinsi.nama',
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



    <?php $this->beginBlock('Kecamatan'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> '.'List All'.' Kecamatan', ['kecamatan/index'],
                ['class' => 'btn text-muted btn-xs']
            )
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.'New'.' Kecamatan',
                ['kecamatan/create', 'Kecamatan' => ['kota_id' => $model->id]], ['class' => 'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjax-Kecamatan',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-Kecamatans ul.pagination a, th a',
        'clientOptions' => ['pjax:success' => 'function(){alert("yo")}'],
    ])
    ?>
    <?=
    '<div class="table-responsive">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getKecamatans(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-kecamatan',
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
                    $params[0] = 'kecamatan'.'/'.$action;
                    return $params;
                },
                'buttons' => [
                ],
                'controller' => 'kecamatan'
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
                    'content' => $this->blocks['Kota'],
                    'active' => true,
                ],
                [
                    'content' => $this->blocks['Kecamatan'],
                    'label' => '<small>Kecamatans <span class="badge badge-default">'.$model->getKecamatans()->count().'</span></small>',
                    'active' => false,
                ],
            ]
        ]
    );
    ?>
</div>
