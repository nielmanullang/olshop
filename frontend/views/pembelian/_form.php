<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pembelian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produk_id')->textInput() ?>

    <?= $form->field($model, 'waktu_pembelian')->textInput() ?>

    <?= $form->field($model, 'pelanggan_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
