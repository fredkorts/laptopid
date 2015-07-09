<?php

use yii\helpers\Html;
use app\models\Field;
use app\models\Product;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
// $field = Field::find()->where(['id' => $model->field_id])->one();
$id = Yii::$app->getRequest()->getQueryParam('id');
$product = Product::findOne($id);
$field = Field::findOne($id);
$productName = $product->mfr.' '.$product->model;
$this->title = Yii::t('app', 'Muuda {modelClass}', [
    'modelClass' => 'komponenti',
]);
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Komponent'), 'url' => ['./']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $productName, 'url' => ['./product/view/', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Muuda komponenti');
?>
<div class="product-update">
	
    <h1><?= Html::encode($this->title . ': '. $field->name. ' ' .$field->model. ' ' .$cnv->cnv($field->value).$field->unit) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
