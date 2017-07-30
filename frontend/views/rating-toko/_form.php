<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RatingToko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-toko-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'toko_id')->textInput() ?>

    <?= $form->field($model, 'pelanggan_id')->textInput() ?>

    <?= $form->field($model, 'rating_toko')->textInput() ?>

    <?= $form->field($model, 'komentar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
