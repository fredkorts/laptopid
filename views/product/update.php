<?php

use yii\helpers\Html;
use app\models\Field;
use app\models\FieldType;
use app\models\ProductField;
use app\models\Product;

$soodus = '';
$pid = $model->getAttribute('id');
$p_name = $model->mfr.' '.$model->model;
if($p_name == '- -'){
	$this->title = Yii::t('app', 'Lisa toode');
} else if($p_name == '0 0'){
	$this->title = Yii::t('app', 'Lisa soodustoode');
} else {
	$this->title = Yii::t('app', 'Muuda: '.$p_name);
}
if ($model->cut_price > 0 || $p_name == '0 0'){
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soodustooted'), 'url' => ['index']];
	$soodus = true;
} else {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tooted'), 'url' => ['/product']];
	$soodus = false;
}
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-update">
	
    <h1><?= Html::encode($this->title) ?></h1>
	
    <?= $this->render('_form', [
        'model' => $model,
		'pid' => $pid,
		'soodus' => $soodus,
    ]) ?>
	
	<?= $this->render('_componentForm', [
		'pid' => $pid,
    ]) ?>
	
</div>