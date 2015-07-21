<?php

use yii\helpers\Html;
use app\models\Field;
use app\models\FieldType;
use app\models\ProductField;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
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
<?php 
	$idx = 0;
	$field_types = FieldType::find()->orderBy('order_by')->all();
	foreach($field_types as $ft)
	{
		echo "<div id='pf_".$idx."'>";
		$multiple = $ft->getAttribute('multiple');
		$showed_component = false;
		echo $ft->getAttribute('name').': ';
		$fields = Field::find()->where(['type_id' =>$ft->getAttribute('id')])->all();
		foreach($fields as $f)
		{
			$product_field = ProductField::find()->where(['field_id' => $f->getAttribute('id'), 'product_id' => $pid])->all();
			foreach($product_field as $pf)
			{
				$showed_component = true;
				
				echo '<input autocomplete="off" id="productfield-field_id_'.$idx.'" value="'.$pf->getAttribute('field_id').'" class="form-control" type="text"><br>';;
				echo $this->render('/product-field/_form', [ 'model' => $pf ]);
				echo Html::a(Yii::t('app', 'Kustuta komponent'), ['/product-field/delete', 'id' => 
								$pf->id], 
								[ 'class' => 'btn btn-danger', 'data' => 
								[ 'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'), 
								'method' => 'post',],]).'<br>';
			}
		}
		if($multiple)
		{
			if(!$showed_component)
			{
				echo '<input autocomplete="off" id="productfield-field_id_'.$idx.'" class="form-control" type="text"><br>';;
				echo $this->render('/product-field/_form', [ 'model' => new ProductField() ]);
			}
			// TODO: (16.07.2015 Caupo) Siia teha button, millele peale vajutades renderdab jqueryga uue product_field formi.
			//		Kuid võib juhtuda, et jquery renderdatud formid ei pruugi saada andmeid kätte, kuna javascript varem koostatud or smth.
			//		Siis sellisel juhul pakkuda välja laternative lahendus, et multiple komponentidele panna alguses hiddeniga mingi ~10 komponendi formi
			//		Ja teha mingi nupp siia juurde, mis siis toggledab et hidden või mitte.
		}
		else
		{
			if(!$showed_component)
			{
				echo '<input autocomplete="off" id="productfield-field_id_'.$idx.'" class="form-control" type="text"><br>';;
				echo $this->render('/product-field/_form', [ 'model' => new ProductField() ]);
			}
		}
		$idx ++;
		echo "</div>";
		echo '<br>';
	}
?>
</div>

<?php
$field_types = FieldType::find()->orderBy('order_by')->all();
echo '<script>';
$index = 0;
foreach($field_types as $ft)
{
	echo 'var components_'.$index.' = [';
	$fields = Field::find()->where(['type_id' => $ft->getAttribute('id')])->all();
	foreach($fields as $f)
	{
		echo "{ value: '".$f->getAttribute('name')." ".$f->getAttribute('model')."', data: '".$f->getAttribute('id')."' },";
	}
	echo '];';
	echo "$('#pf_".$index." input[id=productfield-field_id_".$index."').autocomplete({";
	echo "lookup: components_".$index.",";
	echo "onSelect: function (suggestion) {";
	echo "$('#pf_".$index." input[id=productfield-field_id]').val(suggestion.data);";
	echo "$('#pf_".$index." input[id=productfield-product_id]').val(".$pid.");";
	echo "$('#pf_".$index." input[id=productfield-field_id_".$index."]').val(suggestion.value);";
	echo "}});";
	$index ++;
}
echo '</script>';
?>
<script>
	var idxx = 0;
	$( document ).ready(function() {
		$( "input[id^='productfield-field_id']" ).each(function( index, element ) {
			var _val = parseInt($(this).val()); // _val on pf.field_id
			if(_val > 0)
			{
				$.ajax({
				  url: "/index.php/product/getfieldname/"+_val,
				  context: document.body,
				  dataType: "text"
				}).done(function(data) {
					$( "input[id^='productfield-field_id_']" ).each(function( index, element ) {
						var _idx = 0;
						var _val1 = parseInt($(this).attr('value'));
						if(_val1 == _val)
						{
							$(this).val(data);	
							idxx ++;
						}
						_idx ++;
					});
				});
			}
		});
	});
</script>
 <button type="button" onclick="salvesta()" class="btn btn-success">Salvesta</button> 
 <script>
	function salvesta()
	{
		var data;
		$('form').each(function( index, element ) {
			if($(this).attr('id') != 'w0')
			{
				var _tempindex = index;
				_tempindex --;
				var _id = parseInt($("#productfield-id.form-control").eq(_tempindex).val());
				var _field_id = parseInt($("#productfield-field_id.form-control").eq(_tempindex).val());
				var _product_id = parseInt($("#productfield-product_id.form-control").eq(_tempindex).val());
				if(!isNaN(_id) && _id > 0 && !isNaN(_field_id) && _field_id > 0 && !isNaN(_product_id) && _product_id > 0)
				{
					var posting = $.post( '/index.php/product-field/update/<?php echo $pid; ?>', { 'id': _id, 'product_id': _product_id, 'field_id': _field_id } );
					posting.done(function( data ) {
					});
				}
				else if(!isNaN(_field_id) && _field_id > 0 && !isNaN(_product_id) && _product_id > 0)
				{
					var posting = $.post( '/index.php/product-field/create/<?php echo $pid; ?>', { 'product_id': _product_id, 'field_id': _field_id } );
					posting.done(function( data ) {
					});
				}
			}
		});
		$("#w0").submit();
	}
</script>
