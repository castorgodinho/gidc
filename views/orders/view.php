<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = "Orders";
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode("Order Details") ?></h1>
    <br>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_number',
            'company.name',
            'start_date',
            'built_area',
            'shed_area',
            'shed_no',
            'godown_no',
            'godown_area',
            /* 'end_date', */
        ],
    ]) ?>

    <h3>Plots</h3>

    <?= GridView::widget([
        'dataProvider' => $plots,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'plot.name',
        ],
    ]); ?>


    

</div>
