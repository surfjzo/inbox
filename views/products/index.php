<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataTypeZero yii\data\ActiveDataProvider */
/* @var $dataTypeOne yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

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
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        [
            'attribute' => 'price',
            'format' => ['decimal', 2],
            'value' => function ($model, $key, $index, $widget) {
                return $model->price * \app\models\Currency::getCurrency();
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return '';
                },
                'update' => function ($url, $model, $key) {
                    if (Yii::$app->user->isGuest) {
                        return Html::a('Do login first', '#');
                    } else {
                        return Html::a('Add to cart', \yii\helpers\Url::to(['/cart/create', 'productId' => $key]));
                    }
                },
                'delete' => function ($url, $model, $key) {
                    return '';
                },
            ],
        ]
    ];
    ?>
    <div>
        <h3>Cellphone's</h3>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataTypeZero,
        'columns' => $columns
    ]); ?>
    <div>
        <h3>TV's</h3>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataTypeOne,
        'columns' => $columns
    ]); ?>
    <div>
        <h3>Headphone's</h3>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataTypeTwo,
        'columns' => $columns
    ]); ?>
    <div>
        <h3>Software's</h3>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataTypeThree,
        'columns' => $columns
    ]); ?>
    <div>
        <h3>Storage's</h3>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataTypeFour,
        'columns' => $columns
    ]); ?>
</div>
