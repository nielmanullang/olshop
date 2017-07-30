<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model common\models\RatingToko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-toko-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($ratingtoko, 'rating_toko')->widget(StarRating::classname(), [
        'pluginOptions' => ['size' => 'xs']
    ])->label(false);
    ?>

    <?= $form->field($ratingtoko, 'komentar')->textInput(['maxlength' => true])->textArea(['rows' => '3', 'cols' => '10'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($ratingtoko->isNewRecord ? 'Create' : 'Update', ['class' => $ratingtoko->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
