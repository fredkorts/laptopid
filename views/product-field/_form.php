<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
use app\models\FieldType;


$this->registerJs('
		/*$("#tyybid").change(function() {
			$.ajax({
			  method: "GET",
			  url: "/index.php/field/get-fields-by-type/" + $("#tyybid").val(),
			  dataType: "json"
			}).done(function( data ) {
				var komponendid = new Array();
				for (var i = 0, len = data.length; i < len; i++) {
					var dat = data[i];
					//console.log(dat.name);
					komponendid.push({ value: dat.name, data: dat.id });
				}
				autocomplete_fill(komponendid);
			});
		});*/
');
$this->registerJs('
	
		/*function autocomplete_fill(array)
		{
			console.log(array);
			if ( undefined === array ) {
				alert("test");
			}
			$("#productfield-field_id").autocomplete({
				lookup: array,
				onSelect: function (array) {
					$("#productfield-field_id").val(array.data);
				}
			});
			return 1;
		}*/
');
//$this->registerJsFile('/js/jQuery-Autocomplete/scripts/jquery-2.1.1.js');
//$this->registerJsFile('/js/jQuery-Autocomplete/src/jquery.autocomplete.js');


=======
use app\models\Field;
>>>>>>> ed800b91625eaa8b5e7eb22e803df417ac0ed2ae
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

	<?php $field_types = FieldType::find()->orderBy('id')->all(); ?>	 
    <?php $form = ActiveForm::begin(); ?>
<<<<<<< HEAD
    <?= $form->field($model, 'field_id')->textInput() ?>
	<select id="tyybid">
	<?php
		foreach($field_types as $ft)
		{
			echo '<option value="'.$ft->getAttribute('id').'">'.$ft->getAttribute('name').'</option>';
		}
	?>
	</select> 
	<script>
		/*var komponendid = [
		   { value: 'Intel', data: '1' },
		   { value: 'Kingston', data: '2' },
		   { value: 'Nvidia', data: '3' }
		];*/
		var komponendid = new Array();
		$("#tyybid").change(function() {
			$.ajax({
			  method: "GET",
			  url: "/index.php/field/get-fields-by-type/" + $("#tyybid").val(),
			  dataType: "json"
			}).done(function( data ) {
				komponendid = new Array();
				for (var i = 0, len = data.length; i < len; i++) {
					var dat = data[i];
					komponendid.push({ value: dat.name, data: dat.id });
				}
				//TypeError: $(...).autocomplete is not a function
				$('#productfield-field_id').autocomplete({
					lookup: komponendid,
					onSelect: function (suggestion) {
						alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
						$("#productfield-field_id").val(suggestion.data);
					}
				});
			});
		});

		// Here it works and does the functionality which it should be doing
		$('#productfield-field_id').autocomplete({
			lookup: komponendid,
			onSelect: function (suggestion) {
				alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
				$("#productfield-field_id").val(suggestion.data);
			}
		});
	</script>
	<script>
		//<script src="/js/jQuery-Autocomplete/src/jquery.autocomplete.js"> --- see ka ei töötanud
		///$("#tyybid").change(function() {
			///$.ajax({
			///  method: "GET",
			///  url: "/index.php/field/get-fields-by-type/" + $("#tyybid").val(),
			///  dataType: "json"
			///}).done(function( data ) {
				///var komponendid = new Array();
				///for (var i = 0, len = data.length; i < len; i++) {
				///	var dat = data[i];
					//console.log(dat.name);
				///	komponendid.push({ value: dat.name, data: dat.id });
				///}
				//alert("test");
				///autocomplete_fill(komponendid);
				//$('#productfield-field_id').autocomplete().setOptions(komponendid);
				//TypeError: $(...).autocomplete is not a function
				/*$('#productfield-field_id').autocomplete({
					lookup: komponendid,
					onSelect: function (suggestion) {
						alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
						$("#productfield-field_id").val(suggestion.data);
					}
				});*/
			//});
		//});
	</script>
	<br><br>
	<br>
=======
	
	<?php /* 
			$path = Yii::$app->getRequest()->getPathInfo();
			if(strpos($path,'update') > 0) { 
				$field = Field::find()->where(['id' => $model->field_id])->one();		
				$form->field($field, 'name')->textInput();
			} else {
				$form->field($model, 'field_id')->textInput();
			}*/ ?>
			
    <?=	$form->field($model, 'field_id')->textInput(); ?>
>>>>>>> ed800b91625eaa8b5e7eb22e803df417ac0ed2ae
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Lisa') : Yii::t('app', 'Lisa'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
