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
<div class="toko-view">
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
//            'pelanggan_id',
        ],
    ])
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'produk_id',
            'kategori_id',
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
//                    'produk_berat',
                    'produk_kondisi',
                    'produk_ongkos_kirim',
                    'produk_stok',
                    'produk_diskon',
                // 'toko_id',
//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ])
            ?>
            <h3>Tambah Ulasan <?= Html::encode($model->toko_nama) ?></h3>
            <?=
            $this->render('_form_rating_toko', [
//            'model' => new common\models\RatingProduk(),
                'ratingtoko' => $ratingtoko,
            ])
            ?>
            <br>
            <h3>Ulasan <?= Html::encode($model->toko_nama) ?></h3>
            <div class="container">
                <div class="row"> 
                    <?php
                    $m = 0;
                    $namas = array();
                    $isi_ratings = array();
                    $ratingPelanggan = array();
                    foreach ($ratingtokos as $ratings) {
                        $namas[] = $ratings->pelanggan->pelanggan_nama;
                        $isi_ratings[] = $ratings->komentar;
                        $ratingPelanggan[] = $ratings->rating_toko;
                        $m++;
                    }
                    ?>   
                    <!-- Testimonials -->
                    <?php if($rating==NULL){ ?>
                    <section class="testimonials mt50">
                        <div class="col-md-12 col-sm-12">
                            <div id="owl-reviews" class="owl-carousel mt30">
                                <div class="item">
                                    <?php for ($k = 0; $k < $m; $k++) { ?>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-4 col-sm-2 col-xs-12"> <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/gambar/rating/review-01.png') ?></div> 
                                            <input class="rating" value="<?= $ratingPelanggan[$k] ?>" type="number" showclear="false" showcaption="false" data-size="xs" data-readonly="true" min="0" max="5" step="0.1"/>
                                            <div class="col-lg-10 col-md-8 col-sm-10 col-xs-12">
                                                <div class="text-balloon">
                                                    <?= $isi_ratings[$k] ?><span><?= $namas[$k] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?> 
                        </div>
                    </div>
                </div>
                    </section> <?php }else{
                        echo 'Belum memliki ulasan';
                    }
                    ?>
        </div>
    </div>
</div>  
