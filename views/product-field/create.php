<?php

use yii\helpers\Html;
use app\models\Product;
use app\models\ProductField;
use app\models\Field;
use app\models\FieldType;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
$id = Yii::$app->getRequest()->getQueryParam('id');
$lisa = Yii::$app->getRequest()->getQueryParam('lisa');
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
	
	<?php if($lisa) { ?>
		<?php echo '<input autocomplete="off" id="productfield-field_id_ex" class="form-control" name="ProductField[field_id]_ex" type="text"><br>';?>
		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	<?php } ?>
	<?php
		echo '<script>';
	
		echo 'var components = [';
        $fields = Field::find()->where(['type_id' => $lisa])->all();
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
					$ft = FieldType::findOne($f->type_id);
					if($id == $pf->getAttribute('product_id'))
					{
						echo 	$f->getAttribute('name').' '.
								$f->getAttribute('model').' ';
								if($ft->getAttribute('name') == 'Protsessor'){
									echo $f->value/1000;
								} else {
									echo $f->value;
								}							
						echo	$f->getAttribute('unit').' '.
								$f->getAttribute('price').'€'.'<br>';
						echo Html::a(Yii::t('app', 'Muuda komponenti'), ['/product-field/update', 'id' => $pf->id, 'muuda' => $ft->getAttribute('id')], ['class' => 'btn btn-primary']).' ';
						echo Html::a(Yii::t('app', 'Kustuta komponent'), ['/product-field/delete', 'id' => 
										$pf->id], 
										[ 'class' => 'btn btn-danger', 'data' => 
										[ 'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'), 
										'method' => 'post',],]).'<br>';
						$break = true;			
					}
				}
				echo '<br>'.Html::a(Yii::t('app', 'Lisa/muuda komponenti'), ['/product-field/create', 'id' => $id, 'lisa' => $ft->getAttribute('id')], ['class' => 'btn btn-success']);
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
