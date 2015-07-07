<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
?>
<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'mfr') ?>
	<?= $form->field($model, 'model') ?>
	<?= $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>