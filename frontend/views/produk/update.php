<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = 'Update Produk: ' . $model->produk_id;
$this->params['breadcrumbs'][] = ['label' => 'Produks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->produk_id, 'url' => ['view', 'id' => $model->produk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
