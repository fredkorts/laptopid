<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerJsFile('/js/tinymce/tinymce.min.js');
$this->registerJs('
	tinymce.init({
		selector: "textarea",
		plugins: ["textcolor","advlist","table","image","link","code"],
		tools: "inserttable",
		/*width: "800",*/
		/*height: "300",*/
        convert_urls: false
	});
');
$form = ActiveForm::begin([
	'id' => 'edit-page-form',
	'options' => ['class' => 'form-horizontal'],
]);
?>

	<?= $form->field($model, 'title') ?>
	<?= $form->field($model, 'content')->textArea(['cols' => 5, 'rows' => '20']) ?>

	<?= Html::submitButton('Salvesta', ['class' => 'btn btn-primary']) ?>
	<?= Html::a('Loobu', Url::to(['page/'.$model->id."/".$model->getSafeName()]),['class' => 'reset btn btn-danger']) ?>
<?php ActiveForm::end() ?>