<?php

use yii\helpers\Html;
?>
<tr>
<td>
<center>
<div class="entry-thumbnail col-md-4">
    <a href="?r=toko%2Fview&id=<?= $model->toko_id ?>">
        <?= Html::img(Yii::$app->urlManagerFrontend->baseUrl . '/gambar/logotoko/' . $model->toko_id . '.jpg', ['width' => '130', 'height' => '180']) ?>
        
    </a>
</div></center>
<div class="col-md-7">
	<div class="meta" style="background-color:rgba(255, 255, 255, 0.65);">
		<h3 style="margin-top: 5px; background-color:rgba(255, 255, 255, 0.65);">
		    <a href="?r=toko%2Fview&id=<?= $model->toko_id?>"><?= $model->toko_nama ?></a>
		</h3>
		    Toko:
		    <b><?= $model->toko_nama ?></b>
                    <br>Slogan Toko:
                    <b><?= $model->toko_slogan ?></b>
                    <br>Alamat Toko:
		    <b><?= $model->toko_alamat ?></b>
                    <br><br>
	</div>
	<p style="background-color:rgba(255, 255, 255, 0.65);">
	   <?= Html::a('Lihat Selengkapnya', ['toko/view', 'id'=>$model->toko_id], ['class' => 'btn btn-sm btn-primary']) ?>
	</p><hr>
</div>
</td>
</tr>
