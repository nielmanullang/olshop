<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProdukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'produk_nama') ?>
    
    <?php // echo $form->field($model, 'produk_berat') ?>

    <?php // echo $form->field($model, 'produk_kondisi') ?>

    <?php // echo $form->field($model, 'produk_ongkos_kirim') ?>

    <?php // echo $form->field($model, 'produk_rating') ?>

    <?php // echo $form->field($model, 'produk_stok') ?>

    <?php // echo $form->field($model, 'produk_diskon') ?>

    <?php // echo $form->field($model, 'toko_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
