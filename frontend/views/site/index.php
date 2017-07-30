<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = 'Olshop';
?>
<div class="site-index">

    <div class="col-md-6">
        <div class="testimonial" style="padding-left:30px ;background-color:rgba(255, 255, 255, 0.65);" >
            <h1 align="center" style="color:#085A8A"><b>Produk </b></h1>
            <div class="media-body">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_view1',
                    'summary' => '',
                ]);
                ?>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="testimonial" style="padding-left:30px ;background-color:rgba(255, 255, 255, 0.65);" >
            <h1 align="center" style="color:#085A8A"><b>Toko </b></h1>
            <div class="media-body">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProviderToko,
                    'itemView' => '_view2',
                    'summary' => '',
                ]);
                ?>
            </div>
        </div>

    </div>
</div>
