<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Field;
use app\models\FieldType;
use app\models\ProductField;
use app\models\Product;

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
<button type="button" onclick="salvesta()" class="btn btn-success">Salvesta</button> 

