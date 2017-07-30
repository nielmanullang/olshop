<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model common\models\RatingProduk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-produk-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($ratingproduk, 'rating_produk')->widget(StarRating::classname(), [
        'pluginOptions' => ['size' => 'xs']
    ])->label(false);
    ?>

    <?= $form->field($ratingproduk, 'komentar')->textInput(['maxlength' => true])->textArea(['rows' => '3', 'cols' => '10'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($ratingproduk->isNewRecord ? 'Tambah' : 'Update', ['class' => $ratingproduk->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
