<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var fredyns\daerahIndonesia\models\Kelurahan $model
*/

$this->title = Yii::t('app', 'Kelurahan') . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kelurahans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="giiant-crud kelurahan-update">

    <h1>
        <?= Yii::t('app', 'Kelurahan') ?>
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
