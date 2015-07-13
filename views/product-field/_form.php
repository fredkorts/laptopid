<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FieldType;
use app\models\Field;
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
	<div class="hidden"> 
		<?= $form->field($model, 'field_id')->textInput() ?>	
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Lisa') : Yii::t('app', 'Lisa'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
