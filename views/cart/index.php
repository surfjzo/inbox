<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Currency (<?=\app\models\Users::getCurrency()?>) <b class="caret"></b></a>
        <?php
        if (Yii::$app->user->isGuest) {
            $itens = [
                ['label' => 'Do login to change the currency', 'url' => '#']
            ];
        } else {
            $itens = [
                ['label' => 'USD', 'url' => \yii\helpers\Url::to(['/users/update', 'currency' => 'USD'])],
                ['label' => 'EUR', 'url' => \yii\helpers\Url::to(['/users/update', 'currency' => 'EUR'])],
                ['label' => 'BRL', 'url' => \yii\helpers\Url::to(['/users/update', 'currency' => 'BRL'])],
            ];
        }
        echo Dropdown::widget([
            'items' => $itens,
        ]);
        ?>
    </div>
    <?php

    $gridColumns = [
        [
            'attribute' => 'product.name',
            'pageSummary' => 'Total',
        ],
        [
            'attribute' => 'product.price',
            'hAlign' => 'right',
            'vAlign' => 'middle',
            'width' => '10%',
            'format' => ['decimal', 2],
            'pageSummary' => true,
            'value' => function ($model, $key, $index, $widget) {
                return $model->product->price * \app\models\Currency::getCurrency();
            },
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'urlCreator' => function($action, $model, $key, $index) { return '#'; },
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return '';
                },
                'update' => function ($url, $model, $key) {
                    return '';
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('Remove', \yii\helpers\Url::to(['/cart/delete', 'id' => $key]));
                },
            ],
        ],
    ];

    echo GridView::widget([
        'id' => 'kv-grid-demo',
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo

    // parameters from the demo form
    'showPageSummary' => true,
    ]);

    ?>

    <?php
    if (!\app\models\Cart::isEmpty()) {
        echo Html::a('Checkout', \yii\helpers\Url::to(['/checkout/create']), ['class' => 'btn btn-success pull-right']);
    }
    ?>

</div>
