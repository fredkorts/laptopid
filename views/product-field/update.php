<?php

use yii\helpers\Html;
use app\models\Field;
use app\models\ProductField;
use app\models\Product;
use app\models\FieldType;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
// $field = Field::find()->where(['id' => $model->field_id])->one();
$id = Yii::$app->getRequest()->getQueryParam('id');
$product_field = ProductField::findOne($id);
$product = Product::findOne($product_field->getAttribute('product_id'));
$field = Field::findOne($product_field->getAttribute('field_id'));
$field_type = FieldType::findOne($field->id);
$productName = $product->mfr.' '.$product->model;
$this->title = Yii::t('app', 'Muuda {modelClass}', [
    'modelClass' => 'komponenti',
]);
$field_type_name = $field_type->name;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Komponent'), 'url' => ['./']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $productName, 'url' => ['product-field/create/', 'id' => $product->id]];
$this->params['breadcrumbs'][] = Yii::t('app', $this->title);
?>
<div class="product-update">
	
	<?php 	
			$field_value = 0;
			if($field_type->name == 'Protsessor'){
				$field_value = $field->value/1000;
			} else {
				$field_value = $field->value;
				} 
	?>
    <h1><?= Html::encode($this->title . ': '
						. $field->name. ' ' 
						.$field->model. ' ' 
						.$field_value
						.$field->unit) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
