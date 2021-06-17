<?php

use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var fredyns\region\models\search\SubdistrictSearch $searchModel
 */
$this->title = Yii::t('region', 'Subdistrict');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = $this->title;

\yii\widgets\Pjax::begin([
    'id' => 'pjax-main',
    'enableReplaceState' => false,
    'linkSelector' => '#pjax-main ul.pagination a, th a',
    'clientOptions' => ['pjax:success' => 'function(){alert("yo")}'],
]);
?>
    <div class="giiant-crud subdistrict-index">

        <h1>
            <?= Yii::t('region', 'Subdistrict') ?>
            <small>
                <?= Yii::t('region', 'List') ?>
            </small>
        </h1>

        <div class="clearfix crud-navigation">
            <div class="pull-left">
                <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('region', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <hr/>

        <div class="table-responsive">
            <?=
            GridView::widget([
                'layout' => '{summary}{pager}{items}{pager}',
                'dataProvider' => $dataProvider,
                'pager' => [
                    'class' => yii\widgets\LinkPager::class,
                    'firstPageLabel' => Yii::t('region', 'First'),
                    'lastPageLabel' => Yii::t('region', 'Last'),
                ],
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                'headerRowOptions' => ['class' => 'x'],
                'columns' => [
                    [
                        'class' => \yii\grid\SerialColumn::class,
                    ],
                    'number',
                    'name',
                    [
                        'label' => 'District',
                        'attribute' => 'district.name',
                    ],
                    [
                        'class' => \yii\grid\ActionColumn::class,
                        'template' => "{view} {update}",
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return ["/region/subdistrict/{$action}", 'id' => $model->id];
                        },
                        'contentOptions' => ['nowrap' => 'nowrap'],
                    ],
                ],
            ]);
            ?>
        </div>

    </div>

<?php
\yii\widgets\Pjax::end();