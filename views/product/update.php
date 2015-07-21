<?php

use yii\helpers\Html;
use app\models\Field;
use app\models\FieldType;
use app\models\ProductField;
use app\models\Product;

$pid = $model->getAttribute('id');
$this->title = 'Muuda: '.$model->mfr.' '.$model->model;
if ($model->cut_price > 0){
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soodustooted'), 'url' => ['index']];
} else {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tooted'), 'url' => ['/product']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-update">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'soodus' => '',
    ]) ?>
	    <?= $this->render('_componentForm', [
        'model' => $model,
		'pid' => $pid,
    ]) ?>	
</div>
