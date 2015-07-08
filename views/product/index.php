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
        <?= Html::a(Yii::t('app', 'Lisa komponent'), ['/product-field/create'], ['class' => 'btn btn-success']) ?>
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
            'price',
            'cut_price',
            'stock',
            'active',
            'description:ntext',
            'highlighted',
        ],
    ]);
	for($i = 0; $i < count($model->field); $i++)
	{
		for($t = 0; $t < count($model->field_type); $t++)
		{
			if($model->field_type[$t][0]->getAttribute('id') == $model->field[$i][0]->getAttribute('type_id'))
			{
				echo $model->field_type[$t][0]->getAttribute('name').': ';
			}
		}
		echo $model->field[$i][0]->name.' ';
		echo $model->field[$i][0]->model.' ';
		echo $model->field[$i][0]->value.'<br>';
		echo Html::a(Yii::t('app', 'Muuda komponenti'), ['/product-field/update', 'id' => $model->product_field[$i]->id], ['class' => 'btn btn-primary']).' ';
		echo Html::a(Yii::t('app', 'Kustuta komponent'), ['/product-field/delete', 'id' => $model->product_field[$i]->id], [ 'class' => 'btn btn-danger', 'data' => [ 'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'), 'method' => 'post',],]);
		echo '<br><br>';
	}

	}?>
</div>
