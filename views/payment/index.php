<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Payment', ['search'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'invoice.invoice_code',
            'amount',
            'start_date',
            'mode',
            'invoice.order.company.name',
            //'invoice_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
