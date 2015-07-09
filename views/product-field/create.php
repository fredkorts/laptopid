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


$this->title = Yii::t('app', 'Lisa tootele komponent');
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
 
		<?php 
		$product_fields = ProductField::find()->where(['product_id' => $id])->all();
		$pfids=array();
		foreach($product_fields as $pf){
			$pfids[] = $pf->getAttribute('field_id');
		}
		$dataProvider = new ActiveDataProvider([
				'query' => Field::find()->where(['id'=> $pfids]),
		]); 
		?>
		<h3>Komponendid</h3>
		<?=GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			'name',
            'model',
            'value',
            'unit',
            'price',            
        ],
    ]);
?>

</div>
