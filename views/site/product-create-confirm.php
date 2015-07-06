<?php
use yii\helpers\Html;
?>

<ul>
    <li><label>Tootja</label>: <?= Html::encode($model->mfr) ?></li>
    <li><label>Mudel</label>: <?= Html::encode($model->model) ?></li>
</ul>