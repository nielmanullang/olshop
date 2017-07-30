<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pelanggan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelanggan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pelanggan_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pelanggan_notelpon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pelanggan_provinsi')->textInput() ?>

    <?= $form->field($model, 'pelanggan_kabupaten')->textInput() ?>

    <?= $form->field($model, 'pelanggan_kecamatan')->textInput() ?>

    <?= $form->field($model, 'pelanggan_alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_pos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
