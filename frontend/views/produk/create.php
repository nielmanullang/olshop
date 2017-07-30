<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = 'Tambah Barang';
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
