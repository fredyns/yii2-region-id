<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var fredyns\daerahIndonesia\models\Kecamatan $model
*/

$this->title = Yii::t('app', 'Kecamatan') . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kecamatans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud kecamatan-update">

    <h1>
        <?= Yii::t('app', 'Kecamatan') ?>
        <small>
                        <?= $model->id ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
