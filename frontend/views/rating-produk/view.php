<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RatingProduk */

$this->title = $model->rating_id;
$this->params['breadcrumbs'][] = ['label' => 'Rating Produks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-produk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rating_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rating_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rating_id',
            'produk_id',
            'pelanggan_id',
            'rating_produk',
            'komentar',
        ],
    ]) ?>

</div>
