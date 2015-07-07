<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Lisa toode';
$this->params['breadcrumbs'][] = ['label' => 'Tooted', 'url' => ['/site/tooted']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['options' => [
			'id' => 'create-product-form', 
			'class' => 'form-horizontal',	
			],
		]); 
	?>
	<?= $form->field($model, 'mfr') ?>
	<?= $form->field($model, 'model') ?>
	<?= $form->field($model, 'description')->textarea(array('rows'=>5,'cols'=>5)); ?>
	<?= $form->field($model, 'price') ?>
	<?= $form->field($model, 'cut_price') ?>
	<?= $form->field($model, 'stock') ?>	
	<?= $form->field($model, 'active')->checkbox(); ?>
	<?= $form->field($model, 'highlighted')->checkbox(); ?>

    <div class="form-group">
         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>