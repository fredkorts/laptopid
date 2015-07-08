<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = $model->title;
if (isset($model->id) && $model->id > 1)
	$this->params['breadcrumbs'][] = $this->title;

if (isset($message))
	echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
?>
<div class="page-container">
	<?php echo (Yii::$app->user->isGuest ? '' : '<a href="'.Url::to(['edit/page/'.$model->id]).'" class="edit-page"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Muuda lehekülge</a>') ?>
    <h1><?= Html::encode($model->title); ?></h1>
	<div class="page-content">
		<?= $model->content ?>
	</div>
</div>