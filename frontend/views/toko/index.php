<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TokoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Toko';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Toko', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'toko_nama',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('' . $model->toko_nama . '', ['toko/view', 'id' => $model->toko_id]);
                }
                    ],
//                    'toko_nama',
                    'toko_slogan',
//                    'toko_deskripsi:ntext',
                    'toko_alamat',
//                    'toko_rating',
                // 'pelanggan_id',
//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>
