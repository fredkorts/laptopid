<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Field */

$this->title = 'Lisa komponent';
$this->params['breadcrumbs'][] = ['label' => 'Komponendid', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
