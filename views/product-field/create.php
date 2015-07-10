<?php

use yii\helpers\Html;
use app\models\Product;
use app\models\ProductField;
use app\models\Field;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
$id = Yii::$app->getRequest()->getQueryParam('id');
$product = Product::findOne($id);


$this->title = Yii::t('app', 'Lisa/muuda komponente');
if($product->cut_price == 0) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tooted'), 'url' => ['./product/']];
} else {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soodustooted'), 'url' => ['./']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 <?= DetailView::widget([
        'model' => $product,
        'attributes' => [
            'id',
            'mfr',
            'model',
            'price',
            'cut_price',
            'stock',
            'active',
            'description:ntext',
            'highlighted',
        ],
    ]) ?>
 
		<h3>Komponendid</h3>
		<?php 
		$product_fields = ProductField::find()->where(['product_id' => $id])->all();
		$pfids=array();
		foreach($product_fields as $pf){
			$f = Field::findOne($pf->getAttribute('field_id'));
			//foreach($fields as $f){
				echo $f->name.' ';
				echo $f->model.' ';
				echo $f->value.' ';
				echo $f->unit.' ';
				echo $f->price.'€'.'<br>';
				echo Html::a(Yii::t('app', 'Muuda komponenti'), ['/product-field/update', 'id' => $pf->id], ['class' => 'btn btn-primary']).' ';
				echo Html::a(Yii::t('app', 'Kustuta komponent'), ['/product-field/delete', 'id' => 
										$pf->id], 
										[ 'class' => 'btn btn-danger', 'data' => 
										[ 'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'), 
										'method' => 'post',],]);
										echo '<br><br>';
			//}
		}
		?>
		<?php
		?>


</div>
