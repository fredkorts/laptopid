<?php

use yii\helpers\Html;
use app\models\FieldType;

/* @var $this yii\web\View */
/* @var $model app\models\Field */

$field_type = FieldType::findOne(['id' => $model->type_id]);

$full_name = $model->name. ' ' . $model->model. ' '.$model->value.$model->unit;
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
<?php  
	echo $field_type->name.': '.$model->name.' '.$model->model.'<br>';
	if($field_type->name == 'Protsessor')
	echo 'Kiirus: '.$model->value.' '.$model->unit.'<br><br>';
	echo 'Hind: '.$model->price.'€';
?>
</div>
