<?php

use yii\helpers\Html;
use app\models\Field;
use app\models\FieldType;
use app\models\ProductField;
use app\models\Product;
use yii\widgets\DetailView;
$id = Yii::$app->getRequest()->getQueryParam('id');
$muuda = Yii::$app->getRequest()->getQueryParam('muuda');
$product_field = ProductField::findOne($id);
$product = Product::findOne($product_field->getAttribute('product_id'));
$field = Field::findOne($product_field->getAttribute('field_id'));
$productName = $product->mfr.' '.$product->model;
$productFieldName = $field->name.' '.$field->model;
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
	<?php if($muuda) { ?>
		<?php echo '<input autocomplete="off" id="productfield-field_id_ex" class="form-control" name="ProductField[field_id]_ex" type="text"><br>';?>
		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	<?php } ?>
	<?php
		echo '<script>';
	
		echo 'var components = [';
        $fields = Field::find()->where(['type_id' => $muuda])->all();
		foreach($fields as $f)
		{
			echo "{ value: '".$f->getAttribute('name')." ".$f->getAttribute('model')."', data: '".$f->getAttribute('id')."' },";
		}
        echo '];';
		echo "$('#productfield-field_id_ex').autocomplete({";
		echo "lookup: components,";
		echo "onSelect: function (suggestion) {";
		echo "$('#productfield-field_id').val(suggestion.data);";
		echo "$('#productfield-field_id_ex').val(suggestion.value);";
		echo "}});";
		echo "$('#productfield-field_id_ex').val('".$productFieldName."');";
		echo '</script>';
	?>
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
		$field_types = FieldType::find()->all();
		$break = false;
		foreach($field_types as $ft)
		{
			echo $ft->getAttribute('name').': ';
			$fields = Field::find()->where(['type_id' =>$ft->getAttribute('id')])->all();
			foreach($fields as $f)
			{
				$product_field = ProductField::find()->where(['field_id' => $f->getAttribute('id')])->all();
				foreach($product_field as $pf)
				{
					if($id == $pf->getAttribute('product_id'))
					{
						echo $f->getAttribute('name').' '.$f->getAttribute('model').'<br>';
						echo Html::a(Yii::t('app', 'Muuda komponenti'), ['/product-field/update', 'id' => $pf->id, 'muuda' => $ft->getAttribute('id')], ['class' => 'btn btn-primary']).' ';
						echo Html::a(Yii::t('app', 'Kustuta komponent'), ['/product-field/delete', 'id' => 
										$pf->id], 
										[ 'class' => 'btn btn-danger', 'data' => 
										[ 'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'), 
										'method' => 'post',],]).'<br>';
						$break = true;			
					}
				}
				echo '<br>'.Html::a(Yii::t('app', 'Lisa/muuda komponente'), ['/product-field/create', 'id' => $id, 'lisa' => $ft->getAttribute('id')], ['class' => 'btn btn-success']);
				echo '<br>';
				if($break)
				{
					$break = false;
					break;
				}
			}
			echo '<br>';
		}
	?>

</div>
