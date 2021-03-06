<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'number',
            [
                'attribute' => 'Satus',
                'headerOptions' => ['style' => 'min-width:150px'],
                'value' => function ($model) {
                    return \app\models\Order::ORDER_STATUS[$model->status];
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'size' => Select2::MEDIUM,
                    'attribute' => 'status',
                    'data' => app\models\Order::ORDER_STATUS,
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => 'Выберите тип..'
                    ],
                ])
            ],
            'customer_name',
            [
                'attribute' => 'Products',

                'value' => function ($model) {
                    $products = '';
                    foreach ($model->products as $product)
                    {
                        $products .= $product->name.'; ';
                    }
                    return $products;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
