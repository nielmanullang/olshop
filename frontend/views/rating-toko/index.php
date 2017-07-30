<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RatingTokoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rating Tokos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-toko-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rating Toko', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rating_id',
            'toko_id',
            'pelanggan_id',
            'rating_toko',
            'komentar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
