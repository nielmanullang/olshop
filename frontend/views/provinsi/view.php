<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Provinsi */

$this->title = $model->provinsi_id;
$this->params['breadcrumbs'][] = ['label' => 'Provinsis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provinsi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->provinsi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->provinsi_id], [
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
            'provinsi_id',
            'nama',
        ],
    ]) ?>

</div>
