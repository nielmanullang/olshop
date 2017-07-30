<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RatingProdukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-produk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rating_id') ?>

    <?= $form->field($model, 'produk_id') ?>

    <?= $form->field($model, 'pelanggan_id') ?>

    <?= $form->field($model, 'rating_produk') ?>

    <?= $form->field($model, 'komentar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
