<?php

use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var fredyns\region\models\search\ProvinceSearch $searchModel
 */
$this->title = Yii::t('region', 'Province');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/' . Yii::$app->controller->module->id]];
$this->params['breadcrumbs'][] = $this->title;

\yii\widgets\Pjax::begin([
    'id' => 'pjax-main',
    'enableReplaceState' => false,
    'linkSelector' => '#pjax-main ul.pagination a, th a',
    'clientOptions' => ['pjax:success' => 'function(){alert("yo")}'],
])
?>
    <div class="giiant-crud province-index">

        <h1>
            <?= Yii::t('region', 'Provinces') ?>
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
                        'class' => \yii\grid\ActionColumn::class,
                        'options' => [],
                        'template' => "{view} {update}",
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return ["/region/province/{$action}", 'id' => $model->id];
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
