<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Toko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toko-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'toko_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'toko_slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'toko_deskripsi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'toko_alamat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
