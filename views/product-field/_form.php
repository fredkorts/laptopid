<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Field;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php /* 
			$path = Yii::$app->getRequest()->getPathInfo();
			if(strpos($path,'update') > 0) { 
				$field = Field::find()->where(['id' => $model->field_id])->one();		
				$form->field($field, 'name')->textInput();
			} else {
				$form->field($model, 'field_id')->textInput();
			}*/ ?>
			
    <?=	$form->field($model, 'field_id')->textInput(); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Lisa') : Yii::t('app', 'Lisa'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
