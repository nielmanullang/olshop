<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Produk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'produk_id',
//            'produk_nama',
//            [
//                'attribute' => 'kategori',
//                'format' => 'raw',
//                'value' => function($model) {
//                    return Html::a('' . $model->kategori_id . '', ['kategori/view', 'id' => $model->kategori_id]);
//                }
//            ],
                'kategori.kategori_name',
            [
                'attribute' => 'produk_nama',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('' . $model->produk_nama . '', ['produk/view', 'id' => $model->produk_id]);
                }
                    ],
                    'produk_harga',
//                    'produk_berat',
                    'produk_kondisi',
                    'produk_ongkos_kirim',
//                    'produk_rating',
                    'produk_stok',
                    'produk_diskon',
                // 'toko_id',
//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>
