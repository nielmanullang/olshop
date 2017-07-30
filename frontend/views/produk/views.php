<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Toko;
use common\models\Pelanggan;
use kartik\rating\StarRating;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = $model->produk_nama;
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produk-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-12">
        <div class="col-md-3">
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <?= Html::a('Beli', ['beli', 'id' => $model->produk_id], ['class' => 'btn btn-danger']) ?>
                <?php
            } else {
                $pelanggan = Pelanggan::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                $pemilik_toko = Toko::find()->where(['pelanggan_id' => $pelanggan->pelanggan_id])->one();
                $toko = Toko::findOne($model->toko_id);
                if ($pemilik_toko == NULL) {
                    if ($model->produk_stok > 0) {
                        echo Html::a('Beli', ['beli', 'id' => $model->produk_id], ['class' => 'btn btn-danger']);
                    } else {
                        echo 'Stok Habis';
                    }
                    ?>

                    <p>
                        <?php
                    } else {
                        if ($toko->toko_id == $pemilik_toko->toko_id) {
                            ?>
                            <?= Html::a('Update', ['update', 'id' => $model->produk_id], ['class' => 'btn btn-primary']) ?>
                            <?=
                            Html::a('Delete', ['delete', 'id' => $model->produk_id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                            <?php
                        } else {
                            ?>
                            <?= Html::a('Beli', ['beli', 'id' => $model->produk_id], ['class' => 'btn btn-danger']) ?>
                        <p>
                            <?php
                        }
                    }
                }
                ?>
        </div>
        <div class="col-md-9">
            <?php
            echo StarRating::widget([
                'name' => 'rating',
                'value' => $rating,
                'pluginOptions' => ['displayOnly' => true]
            ]);
            ?>
        </div>
    </div>
    <!--    <p>
    
    </p>-->


    <p>
    <div class="col-md-12">
        <div class="col-md-3">
            <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/gambar/produk/' . $model->produk_id . '.jpg', ['width' => '180', 'height' => '255']) ?>
        </div>
        <div class="col-md-9"> 
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'kategori.kategori_name',
//                    'produk_nama',
                    'produk_harga',
//                    'produk_kategori',
                    'produk_berat',
                    'produk_kondisi',
                    'produk_ongkos_kirim',
//                    'produk_rating',
                    'produk_stok',
                    'produk_diskon',
                    'toko.toko_nama',
                ],
            ])
            ?>
        </div>     
        <br>
        <h3>Ulasan <?= Html::encode($model->produk_nama) ?></h3>
        <div class="container">
            <div class="row"> 
                <?php
                $m = 0;
                $namas = array();
                $isi_ratings = array();
                $ratingPelanggan = array();
                foreach ($ratingproduks as $ratings) {
                    $namas[] = $ratings->pelanggan->pelanggan_nama;
                    $isi_ratings[] = $ratings->komentar;
                    $ratingPelanggan[] = $ratings->rating_produk;
                    $m++;
                }
                ?>   
                <!-- Testimonials -->
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
                </section>
            </div>
        </div>
    </div>  
</div>
