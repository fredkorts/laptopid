<?php

use yii\helpers\Html;
use app\models\FieldType;
/* @var $this yii\web\View */
/* @var $model app\models\Field */
$field_types = FieldType::find()->where(['id' => $model->type_id])->all();
$value = $model->value;
foreach($field_types as $ft){
	if($ft->name == 'Protsessor')
	$value = $value/1000;
}
$full_name = $model->name. ' ' . $model->model. ' '.$value.$model->unit ;
$this->title = 'Muuda komponenti: ' .$full_name;
$this->params['breadcrumbs'][] = ['label' => 'Komponendid', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name. ' ' . $model->model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Muuda komponenti';
?>
<div class="field-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
