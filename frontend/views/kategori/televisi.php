<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Kategori */

$this->title = 'Televisi';
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
                // 'toko_id',
//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ])
            ?>

</div>
