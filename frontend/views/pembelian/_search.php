<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PembelianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pembelian_id') ?>

    <?= $form->field($model, 'produk_id') ?>

    <?= $form->field($model, 'waktu_pembelian') ?>

    <?= $form->field($model, 'pelanggan_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
