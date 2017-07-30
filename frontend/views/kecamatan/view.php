<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kecamatan */

$this->title = $model->kecamatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kecamatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kecamatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kecamatan_id], [
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
            'kecamatan_id',
            'kabupaten_id',
            'nama',
        ],
    ]) ?>

</div>
