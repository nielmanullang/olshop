<?php

use yii\helpers\Html;
?>
<tr>
<td>
<center>
<div class="entry-thumbnail col-md-4">
    <a href="?r=produk%2Fview&id=<?= $model->produk_id ?>">
        <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/gambar/produk/' . $model->produk_id . '.jpg', ['width' => '130', 'height' => '180']) ?>
    </a>
</div></center>
<div class="col-md-7">
	<div class="meta" style="background-color:rgba(255, 255, 255, 0.65);">
		<h3 style="margin-top: 5px; background-color:rgba(255, 255, 255, 0.65);">
		    <a href="?r=produk%2Fview&id=<?= $model->produk_id?>"><?= $model->produk_nama ?></a>
		</h3>
		    Penjual:
		    <b><?= $model->toko->toko_nama ?></b>
                    <br>Harga:
                    <b>Rp. <?= $model->produk_harga ?>,-</b>
                    <br>Kondisi
		    <b><?= $model->produk_kondisi ?></b>
                    <br>Ongkos Kirim:
		    <b><?= $model->produk_ongkos_kirim ?></b>
	</div>
	<p style="background-color:rgba(255, 255, 255, 0.65);">
	   <?= Html::a('Lihat Selengkapnya', ['produk/view', 'id'=>$model->produk_id], ['class' => 'btn btn-sm btn-primary']) ?>
	</p><hr>
</div>
</td>
</tr>
