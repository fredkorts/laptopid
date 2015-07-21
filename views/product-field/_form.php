<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FieldType;
use app\models\Field;
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
	<div class="hidden">
		<?= $form->field($model, 'id')->textInput() ?>	
		<?= $form->field($model, 'product_id')->textInput() ?>	
		<?= $form->field($model, 'field_id')->textInput() ?>	
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvesta') : Yii::t('app', 'Salvesta'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>
