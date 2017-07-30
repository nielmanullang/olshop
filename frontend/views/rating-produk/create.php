<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RatingProduk */

$this->title = 'Create Rating Produk';
$this->params['breadcrumbs'][] = ['label' => 'Rating Produks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-produk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
