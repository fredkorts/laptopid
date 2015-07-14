<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\FieldType;

/* @var $this yii\web\View */
/* @var $model app\models\Field */
$field_types = FieldType::find()->where(['id' => $model->type_id])->all();
$value = $model->value;
foreach($field_types as $ft){
	$value = $value/1000;
}

$full_name = $model->name. ' ' . $model->model. ' '.$value.$model->unit;
$this->title = $full_name;
$this->params['breadcrumbs'][] = ['label' => 'Komponendid', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Muuda', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Kustuta', ['delete', 'id' => $model->id], [
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
            'id',
            'type_id',
            'name',
            'model',
            'value',
            'unit',
            'price',
        ],
    ]) ?>

</div>
