<?php

use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var fredyns\region\models\search\PostcodeSearch $searchModel
 */
$this->title = Yii::t('region', 'Postcode');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = $this->title;

\yii\widgets\Pjax::begin([
    'id' => 'pjax-main',
    'enableReplaceState' => false,
    'linkSelector' => '#pjax-main ul.pagination a, th a',
    'clientOptions' => ['pjax:success' => 'function(){alert("yo")}'],
]);
?>
    <div class="giiant-crud postcode-index">

        <h1>
            <?= Yii::t('region', 'Postcodes') ?>
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
                    [
                        'class' => \yii\grid\ActionColumn::class,
                        'template' => "{view} {update}",
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return ["/region/postcode/{$action}", 'id' => $model->id];
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