<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Checkout */

$this->title = 'Checkout Done';
$this->params['breadcrumbs'][] = ['label' => 'Checkout Done'];
?>
<div class="checkout-view">

    <div>
        <h3>Thank you for buying with us, we will send you an email with the payment method.</h3>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'value',
                'label' => 'Total price',
                'format' => ['decimal', 2],
            ]
        ],
    ]) ?>

    <div>
        <h5>INBOX Team</h5>
    </div>

</div>
