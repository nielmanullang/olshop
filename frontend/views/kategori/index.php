<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'kategori_id',
//            'kategori_name',
            [
                'attribute' => 'kategori_name',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('' . $model->kategori_name . '', ['kategori/view', 'id' => $model->kategori_id]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
