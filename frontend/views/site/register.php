<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Kecamatan;
use yii\helpers\ArrayHelper;

$js = '$(".dependent-input").on("change", function() {
	var value = $(this).val(),
		obj = $(this).attr("id"),
		next = $(this).attr("data-next");
	$.ajax({
		url: "' . Yii::$app->urlManager->createUrl('pelanggan/get') . '",
		data: {value: value, obj: obj},
		type: "POST",
		success: function(data) {
			$("#" + next).html(data);
		}
	});
});';
$this->registerJs($js);

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to register:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'pelanggan_nama') ?>
            <?= $form->field($model, 'pelanggan_notelpon') ?>
            <?=
            $form->field($model, 'pelanggan_provinsi')->dropDownList(
                    ArrayHelper::map(Provinsi::find()->all(), 'provinsi_id', 'nama'), [
                'prompt' => Yii::t('app', 'Select Province'),
                'id' => 'provinsi_id',
                'class' => 'dependent-input form-control',
                'data-next' => 'kabupaten_id'
            ])
            ?>
            <?=
            $form->field($model,'pelanggan_kabupaten')->dropDownList(
                    ArrayHelper::map(Kabupaten::find()->where(['nama' => 'a']), 'kabupaten_id', 'nama'), [
                'prompt' => Yii::t('app', 'Select Kabupaten'),
                'id' => 'kabupaten_id',
                'class' => 'dependent-input form-control',
                'data-next' => 'kecamatan_id'
            ])
            ?>
            <?=
            $form->field($model, 'pelanggan_kecamatan')->dropDownList(ArrayHelper::map(Kecamatan::find()->where(['nama' => 'a']), 'kecamatan_id', 'nama'), [
                'prompt' => Yii::t('app', 'Select Kecamatan'),
                'id' => 'kecamatan_id',
            ])
            ?>

            <?= $form->field($model, 'pelanggan_alamat') ?>
            <?= $form->field($model, 'kode_pos') ?>
            <?=
            $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ])
            ?>

            <div class="form-group">
                <?= Html::submitButton('Register', ['class' => 'btn btnprimary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>