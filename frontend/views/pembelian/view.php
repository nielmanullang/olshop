<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pembelian */

$this->title = $model->pembelian_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pembelian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pembelian_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pembelian_id',
            'produk_id',
            'waktu_pembelian',
            'pelanggan_id',
        ],
    ]) ?>

</div>
