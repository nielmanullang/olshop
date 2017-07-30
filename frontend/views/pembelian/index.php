<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembelian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Pembelian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'Waktu_Pembelian',
            'Nama_Barang',
            'Harga',
            'Biaya_Pengiriman',
            'Toko_Penjual',
            'Dikirim_Dari'
//            'pelanggan_id',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
