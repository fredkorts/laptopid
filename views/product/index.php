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
				<?= Html::a(Yii::t('app', 'Lisa soodustoode'), ['create-cut'],[
				'class' => 'btn btn-success', 
				'data' => [
					'confirm' => Yii::t('app', 'Kas soovite lisada uut soodustoodet?'),
					'method' => 'post',
				],
			]) ?>
			</p>
<?php 		break; 
		} else { ?>
			<p>
				<?= Html::a(Yii::t('app', 'Lisa toode'), ['create'], [
					'class' => 'btn btn-success',
					'data' => [
						'confirm' => Yii::t('app', 'Kas soovite lisada uut toodet?'),
						'method' => 'post',
					],
				]) ?>
			</p>
<?php 		break; 
		}
	} ?>

	<?php foreach($models as $model) 
	{ ?>
    <p>
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
	
	$pfids = array();
	foreach($model->field_type[0] as $ft)
	{
		echo $ft->getAttribute('name').':<br>';
		foreach($model->product_field as $pf)
		{
			for($i = 0; $i < count($model->field); $i++)
			{		
				$break = false;
				foreach($pfids as $pfid)
				{
					if($pfid == $pf->getAttribute('id'))
					{
						$break = true;
					}
				}
				if($break)
				{
					break;
				}
				if($model->field[$i][0]->getAttribute('type_id') == $ft->getAttribute('id') && $pf->getAttribute('field_id') == $model->field[$i][0]->getAttribute('id'))
				{
					$pfids[] = $pf->getAttribute('id');
					echo $model->field[$i][0]->name.' ';
					echo $model->field[$i][0]->model.'<br>';
				}
			}
		}
		/*echo $model->field[$i][0]->name.' ';
		echo $model->field[$i][0]->model.' ';
		
		if($model->field_type[$t][0]->name == 'Protsessor'){
			echo $model->field[$i][0]->value/1000;
		} else {
			echo $model->field[$i][0]->value;
		}
		echo $model->field[$i][0]->unit.'<br>';*/		
	}
	echo '<br>';
	}?>
</div>
