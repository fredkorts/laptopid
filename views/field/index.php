<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Komponendid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Lisa komponent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'type_id',
            'name',
            'model',
            'value',
            'unit',
            'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
