<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Lisa toode');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tooted'), 'url' => ['/product']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'soodus' => $soodus,
    ]) ?>
</div>
