<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
foreach($models as $m){
	if($m->cut_price > 0)
	{			
		$this->title = Yii::t('app', 'Soodustooted');	
		$this->params['breadcrumbs'][] = 'Soodustooted';
		break;
	} else {
		$this->title = Yii::t('app', 'Tooted');
		$this->params['breadcrumbs'][] = 'Tooted';
		break;
	}	
}

?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
	foreach($models as $m){
		if($m->cut_price > 0){ ?>
			<p>
				<?= Html::a(Yii::t('app', 'Lisa soodustoode'), ['create-cut'], ['class' => 'btn btn-success']) ?>
			</p>
<?php 		break; 
		} else { ?>
			<p>
				<?= Html::a(Yii::t('app', 'Lisa toode'), ['create'], ['class' => 'btn btn-success']) ?>
			</p>
<?php 		break; 
		}
	} ?>

	<?php foreach($models as $model) 
	{ ?>
    <p>
        <?= Html::a(Yii::t('app', 'Lisa/muuda komponente'), ['/product-field/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Muuda'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Kustuta'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'),
                'method' => 'post',
            ],
        ])?>
		<?= Html::a(Yii::t('app', 'Kopeeri'), ['copy', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		
    </p>
	<?php 
	if($model->cut_price > 0){ 
		echo (DetailView::widget([
			'model' => $model,
			'attributes' => [
				'id',
				'mfr',
				'model',
				'description:ntext',
				'price',
				'cut_price',
				'stock',
				'active',
				'highlighted',
			],
    ]));
	} else {
		echo(DetailView::widget([
			'model' => $model,
			'attributes' => [
				'id',
				'mfr',
				'model',
				'description:ntext',
				'price',
				'stock',
				'active',
				'highlighted',
			],
			]));
	}
	
	
	if(count($model->field) > 0) echo '<h3>Komponendid</h3>';
	for($i = 0; $i < count($model->field); $i++)
	{
		for($t = 0; $t < count($model->field_type); $t++)
		{
			if($model->field_type[$t][0]->getAttribute('id') == $model->field[$i][0]->getAttribute('type_id'))
			{
				echo $model->field_type[$t][0]->getAttribute('name').': ';
				break;
			}
		}
		echo $model->field[$i][0]->name.' ';
		echo $model->field[$i][0]->model.' ';
		
		if($model->field_type[$t][0]->name == 'Protsessor'){
			echo $model->field[$i][0]->value/1000;
		} else {
			echo $model->field[$i][0]->value;
		}
		echo $model->field[$i][0]->unit.'<br>';		
	}
	echo '<br>';
	}?>
</div>
