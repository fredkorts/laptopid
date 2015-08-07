<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mfr')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
	<?php 	
	if(!$soodus) {
		echo '<label class="cbx-label" for="isCut">Lisa soodushind?</label>';	
		echo '<input type="checkbox" id="isCut" name="isCut">';
		?>
		<div id="cut_price" style="display:none">
			<?= $form->field($model, 'cut_price')->textInput(['maxlength' => true]);?>
		</div>
<?php
	} else {
		echo $form->field($model, 'cut_price')->textInput(['maxlength' => true]);
	} 		
?>
	
    <?= $form->field($model, 'stock')->textInput() ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'highlighted')->checkbox() ?>
	
    <?php ActiveForm::end(); ?>
	
<script>
	$("#isCut").click(function () {
		$("#cut_price").toggle(500);
	});
</script>
<script>
	var idxx = 0;

	$( document ).ready(function() {
		// muudab input fieldida väärtused tühjaks
		$( "[id^='product-']" ).each(function() {
			if(	$ (this).val() == '0' 
					|| $ (this).val() == '0.00' 
				    || $ (this).val() == '-')	{						
				$ (this).val('');				
			}
		});
		// input fieldile peale klikates highlightitakse väärtus
		$( "input[id^='product-']").on("click", function () {
					$(this).select();
		});

		$( "input[id^='productfield-field_id']" ).each(function( index, element ) {
			var _val = parseInt($(this).val()); 
			if(_val > 0)
			{
				$.ajax({
				  url: "/index.php/product/getfieldname/"+_val,
				  context: document.body,
				  dataType: "text"
				}).done(function(data) {
					// input fieldile peale klikates highlightitakse väärtus
					$( "input[id^='product-']").on("click", function () {
							$(this).select();
					});
					$( "input[id^='productfield-field']").on("click", function () {
							$(this).select();
					});
					
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

</div>
