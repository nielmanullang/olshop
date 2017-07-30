<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Toko */

$this->title = 'Update Toko: ' . $model->toko_nama;
$this->params['breadcrumbs'][] = ['label' => 'Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->toko_id, 'url' => ['view', 'id' => $model->toko_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="toko-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
