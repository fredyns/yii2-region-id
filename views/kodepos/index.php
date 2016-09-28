<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var fredyns\daerahIndonesia\models\search\KodeposSearch $searchModel
 */
if (isset($actionColumnTemplates))
{
    $actionColumnTemplate       = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
}
else
{
    Yii::$app->view->params['pageButtons'] = Html::a(
            '<span class="glyphicon glyphicon-plus"></span> '.'New', ['create'], ['class' => 'btn btn-success']
    );
    $actionColumnTemplateString            = "{view} {update} {delete}";
}
?>
<div class="giiant-crud kodepos-index">

    <?php
    \yii\widgets\Pjax::begin([
        'id'                 => 'pjax-main',
        'enableReplaceState' => false,
        'linkSelector'       => '#pjax-main ul.pagination a, th a',
        'clientOptions'      => ['pjax:success' => 'function(){alert("yo")}'],
    ])
    ?>

    <h1>
        <?= Yii::t('app', 'Kodepos') ?>
        <small>
            List
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=
            Html::a('<span class="glyphicon glyphicon-plus"></span> '.'New', ['create'], ['class' => 'btn btn-success'])
            ?>
        </div>

        <div class="pull-right">

            <?=
            \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'          => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'       => '<span class="glyphicon glyphicon-paperclip"></span> '.'Relations',
                    'dropdown'    => [
                        'options'      => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items'        => [
                            [
                                'url'   => ['provinsi/index'],
                                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;'.'Provinsi'.'</i>',
                            ],
                            [
                                'url'   => ['kota/index'],
                                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;'.'Kota'.'</i>',
                            ],
                            [
                                'url'   => ['kecamatan/index'],
                                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;'.'Kecamatan'.'</i>',
                            ],
                            [
                                'url'   => ['kelurahan/index'],
                                'label' => '<i class="glyphicon glyphicon-arrow-right">&nbsp;'.'Kelurahan'.'</i>',
                            ],
                        ]
                    ],
                    'options'     => [
                        'class' => 'btn-default'
                    ]
                ]
            );
            ?>
        </div>
    </div>

    <hr />

    <div class="table-responsive">
        <?=
        GridView::widget([
            'layout'           => '{summary}{pager}{items}{pager}',
            'dataProvider'     => $dataProvider,
            'pager'            => [
                'class'          => yii\widgets\LinkPager::className(),
                'firstPageLabel' => 'First',
                'lastPageLabel'  => 'Last',
            ],
            'filterModel'      => $searchModel,
            'tableOptions'     => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class' => 'x'],
            'columns'          => [
                [
                    'class'      => 'yii\grid\ActionColumn',
                    'options'    => [],
                    'template'   => $actionColumnTemplateString,
                    'urlCreator' => function($action, $model, $key, $index)
                {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params    = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id.'/'.$action : $action;
                    return Url::toRoute($params);
                },
                    'contentOptions' => ['nowrap' => 'nowrap']
                ],
                'nomor',
                [
                    'class'     => yii\grid\DataColumn::className(),
                    'options'   => [],
                    'attribute' => 'kelurahan_id',
                    'value'     => function ($model)
                {
                    if ($rel = $model->getKelurahan()->one())
                    {
                        return Html::a($rel->id, ['kelurahan/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    }
                    else
                    {
                        return '';
                    }
                },
                    'format' => 'raw',
                ],
                [
                    'class'     => yii\grid\DataColumn::className(),
                    'options'   => [],
                    'attribute' => 'kecamatan_id',
                    'value'     => function ($model)
                {
                    if ($rel = $model->getKecamatan()->one())
                    {
                        return Html::a($rel->id, ['kecamatan/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    }
                    else
                    {
                        return '';
                    }
                },
                    'format' => 'raw',
                ],
                [
                    'class'     => yii\grid\DataColumn::className(),
                    'options'   => [],
                    'attribute' => 'kota_id',
                    'value'     => function ($model)
                {
                    if ($rel = $model->getKota()->one())
                    {
                        return Html::a($rel->id, ['kota/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    }
                    else
                    {
                        return '';
                    }
                },
                    'format' => 'raw',
                ],
                [
                    'class'     => yii\grid\DataColumn::className(),
                    'options'   => [],
                    'attribute' => 'provinsi_id',
                    'value'     => function ($model)
                {
                    if ($rel = $model->getProvinsi()->one())
                    {
                        return Html::a($rel->id, ['provinsi/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    }
                    else
                    {
                        return '';
                    }
                },
                    'format' => 'raw',
                ],
            ],
        ]);
        ?>
    </div>

</div>


<?php \yii\widgets\Pjax::end() ?>


