<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\District $model
 */
$this->title = Yii::t('region', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'District'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud district-create">

    <h1>
        <?= Yii::t('region', 'District') ?>
        <small>
            <?= Yii::t('region', 'New') ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('region', 'Cancel'), \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr/>

    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
