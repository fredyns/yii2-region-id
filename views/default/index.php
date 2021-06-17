<?php

use fredyns\region\models\Postcode;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var fredyns\region\models\Postcode $model
 */
$model = new Postcode;
$this->title = Yii::t('region', 'Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('region', 'Region'), 'url' => ['/region']];
?>
<div class="region-default-index">

    <h1>Indonesia Regional Database</h1>

    <p>
        Berisi data seluruh wilayah Indonesia sesuai Permendagri No 39 tahun 2015.

        <?=
        Html::ol(
            [
                Html::a(Yii::t('region', 'Province'), ['province/index']),
                Html::a(Yii::t('region', 'City'), ['city/index']),
                Html::a('District', ['district/index']),
                Html::a('Subdistrict', ['subdistrict/index']),
                Html::a('Postcode', ['postcode/index']),
            ],
            ['encode' => false]
        );
        ?>
    </p>

    <hr/>

    <h3>Contoh Formulir</h3>

    <?= $this->render('/postcode/_form', ['model' => $model]); ?>

    <hr/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>


</div>
