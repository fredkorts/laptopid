<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FieldType;
//use kartik\widgets\Typeahead;
/* @var $this yii\web\View */
/* @var $model app\models\Field */
/* @var $form yii\widgets\ActiveForm */
$value = 0;
?>

<div class="field-form">
    <?php $form = ActiveForm::begin(); ?>
	
	<div class='hidden' method='get'><?= $form->field($model, 'type_id')->textInput() ?></div>	
		
	<b>Tüüp</b>
	<input id="field-type_id_ex" class="form-control" type="text"><br>
					
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Lisa' : 'Salvesta', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
echo '<script>';
echo 'var array = [';
$field_types = FieldType::find()->all();
foreach($field_types as $ft)
{
	echo "{ value: '".$ft->getAttribute('name')."', data: '".$ft->getAttribute('id')."' },";
}
echo '];';
echo "$('#field-type_id_ex').autocomplete({";
echo "lookup: array,";
echo "onSelect: function (suggestion) {";
echo "$('#field-type_id').val(suggestion.data);";
echo "$('#field-type_id_ex').val(suggestion.value);";
echo "}});";
echo '</script>';
?>
<?php if(!$model->isNewRecord){
	$this->registerJs('
$( document ).ready(function() { 
	$.ajax({
		url: "/index.php/field/getname/'.$model->type_id.'",
	}).done(function(data) {
		$("#field-type_id_ex").val(data)
	});
});');
} ?>
</div>