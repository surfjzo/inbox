<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Checkout */

$this->title = 'Create Checkout';
$this->params['breadcrumbs'][] = ['label' => 'Checkouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
