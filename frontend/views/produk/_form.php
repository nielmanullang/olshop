<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Kategori;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produk-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'kategori_id')->dropDownList(ArrayHelper::map(Kategori::find()->asArray()->all(), 'kategori_id', 'kategori_name'), ['prompt'=>'-Select Kategori-']) ?>
    
    <?= $form->field($model, 'produk_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produk_harga')->textInput() ?>

    <?= $form->field($model, 'produk_berat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'produk_kondisi')->dropDownList([ 'Baru' => 'Baru', 'Bekas' => 'Bekas', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'produk_ongkos_kirim')->dropDownList([ 'Gratis' => 'Gratis', 'Berbayar' => 'Berbayar', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'produk_stok')->textInput() ?>

    <?= $form->field($model, 'produk_diskon')->dropDownList([ 'Ada' => 'Ada', 'Tidak Ada' => 'Tidak Ada', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'file')->fileInput(); ?> 
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
