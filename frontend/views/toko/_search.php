<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TokoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toko-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'toko_id') ?>

    <?= $form->field($model, 'toko_nama') ?>

    <?= $form->field($model, 'toko_slogan') ?>

    <?= $form->field($model, 'toko_deskripsi') ?>

    <?= $form->field($model, 'toko_alamat') ?>

    <?php // echo $form->field($model, 'pelanggan_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
