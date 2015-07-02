<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $model->mfr ?>
        <?= $model->model ?>
        <?= $model->price ?>
        <?= $model->cut_price ?>
        <?= $model->stock ?>
        <?= $model->active ?>
        <?= $model->description ?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
