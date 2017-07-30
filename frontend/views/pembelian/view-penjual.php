<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penjualan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-view-penjual">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'Waktu_Pembelian',
            'Nama_Barang',
            'Harga',
            'Biaya_Pengiriman',
            'Nama_Pembeli',
            'Dikirim_Ke'
        ],
    ]); ?>
</div>
