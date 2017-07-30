<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PelangganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelanggan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pelanggan_id') ?>

    <?= $form->field($model, 'pelanggan_nama') ?>

    <?= $form->field($model, 'pelanggan_notelpon') ?>

    <?= $form->field($model, 'pelanggan_provinsi') ?>

    <?= $form->field($model, 'pelanggan_kabupaten') ?>

    <?php // echo $form->field($model, 'pelanggan_kecamatan') ?>

    <?php // echo $form->field($model, 'pelanggan_alamat') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
