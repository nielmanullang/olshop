<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RatingToko */

$this->title = 'Create Rating Toko';
$this->params['breadcrumbs'][] = ['label' => 'Rating Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-toko-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
