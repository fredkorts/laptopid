<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Komponendid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Lisa komponent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'layout'  => "{items}\n{pager}",
        'columns' => [
		   // nummerdus
           // ['class' => 'yii\grid\SerialColumn'],
				[
					'attribute' => 'type_id',
					'value'=>'type.name',
				],
				'name',
				'model',
				'value',
				'unit',
				'price',
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
			],
        ],
    ]); ?>

</div>
