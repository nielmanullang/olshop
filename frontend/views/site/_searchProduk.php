<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterPengumumanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'produk_nama') ?>

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
