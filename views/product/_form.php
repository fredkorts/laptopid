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
	
    <?php if(!(Yii::$app->getRequest()->getPathInfo() == 'product/create')){ ?>		
		<?=$form->field($model, 'cut_price')->textInput(['maxlength' => true]);?>
	<?php } ?> 
	
    <?= $form->field($model, 'stock')->textInput() ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'highlighted')->checkbox() ?>

    <div class="form-group hidden">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Lisa') : Yii::t('app', 'Salvesta'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
