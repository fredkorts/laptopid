<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Field;
use app\models\FieldType;
use app\models\ProductField;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

$pid = $model->getAttribute('id');
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mfr')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
	
	<?php if(!$model->isNewRecord && $model->cut_price <= 0){
		echo 
		'<table style="width:15%">
			<tr>
				<td><input type="checkbox" id="isCut" name="isCut"></td>
				<td>Lisa soodushind?</td>				
			</tr>
		</table>';
	} ?>
	<div id="cut_price" style="display:none">
		<?php if($soodus || !$model->isNewRecord || $model->cut_price > 0) 
					echo $form->field($model, 'cut_price')->textInput(['maxlength' => true]);?>
	</div>
	
    <?= $form->field($model, 'stock')->textInput() ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'highlighted')->checkbox() ?>

    <div class="form-group hidden">
        <?= Html::submitButton($model->isNewRecord 
							? Yii::t('app', 'Lisa') : Yii::t('app', 'Salvesta'), ['class' => $model->isNewRecord
							? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
<script>
	<?php if(!$model->isNewRecord && $model->cut_price <= 0){
		$this->registerJs('
		$("#isCut").click(function () {
			$("#cut_price").toggle(500);
	});');
	} ?>
</script>

</div>
