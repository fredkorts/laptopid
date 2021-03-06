<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Product;
use app\models\ProductField;
use app\models\Field;
use app\models\FieldType;

$this->title = $model->mfr.' '.$model->model;
if ($soodus){
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soodustooted'), 'url' => ['index']];
} else {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tooted'), 'url' => ['/product']];
	}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Muuda'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Kustuta'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php
	 
	$pf = ProductField::findOne(['product_id' => $model->id]);
		$id = $model->id;
		$product_fields = ProductField::find()->where(['product_id' => $id])->all();
		foreach($product_fields as $pf){
				$f = Field::findOne($pf->getAttribute('field_id'));
				$ft = FieldType::findOne($f->type_id);
				echo $ft->name. ': ';
				echo $f->name.' ';
				echo $f->model.' ';
				if($ft->getAttribute('name') == 'Protsessor'){
					echo $f->value/1000;
				} else {
					echo $f->value;
				}								
				echo $f->unit.' '.'<br>';
			}
	echo '<br>Hind: '.$model->price.'€<br>';
	if($model->cut_price > 0) echo 'Soodushind: '.$model->cut_price.'€';
	
	?>
	
	<p>
	Hind sisaldab 20% käibemaksu.
	Võimalik lisada juurde: kõvaketast, mälu ja garantiid, täpsemalt laptopid@laptopid.ee
	Sülearvutite transport üle Eesti tasuta!
	</p>
</div>
