<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RatingProduk */

$this->title = 'Update Rating Produk: ' . $model->rating_id;
$this->params['breadcrumbs'][] = ['label' => 'Rating Produks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rating_id, 'url' => ['view', 'id' => $model->rating_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rating-produk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
