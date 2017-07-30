<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model common\models\Toko */

$this->title = $model->toko_nama;
$this->params['breadcrumbs'][] = ['label' => 'Toko', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-saya">
        <?= Html::a('Edit Toko', ['update', 'id' => $model->toko_id], ['class' => 'btn btn-primary']) ?>
    <div class="col-md-12">
        <div class="col-md-5">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-7">
            <?php
            echo StarRating::widget([
                'name' => 'rating',
                'value' => $rating,
                'pluginOptions' => ['displayOnly' => true]
            ]);
            ?>
        </div>
    </div>


    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'toko_nama',
            'toko_slogan',
            'toko_deskripsi:ntext',
            'toko_alamat',
//            'toko_rating',
//            'pelanggan_id',
        ],
    ])
    ?>
    <?= Html::a('Tambah Barang', ['produk/create'], ['class' => 'btn btn-success']) ?>
    <p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//            'produk_id',
//            'produk_nama',
                [
                    'attribute' => 'produk_nama',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a('' . $model->produk_nama . '', ['produk/view', 'id' => $model->produk_id]);
                    }
                        ],
                        'produk_harga',
                        //'produk_kategori',
                        'produk_berat',
                        'produk_kondisi',
                        'produk_ongkos_kirim',
                        'produk_stok',
                        'produk_diskon',
//                    'produk_rating',
                    // 'toko_id',
//            ['class' => 'yii\grid\ActionColumn'],
                    ],
                ])
                ?>

</div>
