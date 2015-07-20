<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

if(Yii::$app->getRequest()->getPathInfo() == 'product')
		{			
			$this->title = Yii::t('app', 'Tooted');
			$this->params['breadcrumbs'][] = 'Tooted';
		} else {
			$this->title = Yii::t('app', 'Soodustooted');	
			$this->params['breadcrumbs'][] = 'Soodustooted';
		}	
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
	if(Yii::$app->getRequest()->getPathInfo() == 'product'){ ?>
		<p>
			<?= Html::a(Yii::t('app', 'Lisa toode'), ['create'], ['class' => 'btn btn-success']) ?>
		</p>
	<?php } else { ?>
		 <p>
			<?= Html::a(Yii::t('app', 'Lisa soodustoode'), ['create-cut'], ['class' => 'btn btn-success']) ?>
		</p>
	<?php } ?>

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
    <?= DetailView::widget([
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
    ]);
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
	}
	echo '<br>';
	}?>
</div>
