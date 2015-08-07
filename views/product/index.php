<?php

use yii\helpers\Html;

if($soodus)
{			
	$this->title = Yii::t('app', 'Soodustooted');	
	$this->params['breadcrumbs'][] = 'Soodustooted';
} else {
	$this->title = Yii::t('app', 'Tooted');
	$this->params['breadcrumbs'][] = 'Tooted';
}

$identity = Yii::$app->user->identity;
$is_admin = false;
if(isset($identity))
{
	$is_admin = $identity->isAdmin;	
}
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
	
	if($is_admin)
	{
		if($soodus){
			echo '<p>';
				echo Html::a(Yii::t('app', 'Lisa soodustoode'), ['create-cut'],[
					'class' => 'btn btn-success', 
					'data' => [
						'confirm' => Yii::t('app', 'Kas soovite lisada uut soodustoodet?'),
						'method' => 'post',
					],
				]);
			echo '</p>';
		} else {
			echo '<p>';
				echo Html::a(Yii::t('app', 'Lisa toode'), ['create'], [
					'class' => 'btn btn-success',
					'data' => [
						'confirm' => Yii::t('app', 'Kas soovite lisada uut toodet?'),
						'method' => 'post',
					],
				]);
			echo '</p>';
		}	
	}
	foreach($models as $m){
		if($is_admin)
		{
			echo Html::a(Yii::t('app', 'Muuda'), ['update', 'id' => $m->id], ['class' => 'btn btn-primary']);
			echo Html::a(Yii::t('app', 'Kustuta'), ['delete', 'id' => $m->id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => Yii::t('app', 'Oled sa kindel, et soovid seda toodet kustutada?'),
					'method' => 'post',
				],
			]);
			echo Html::a(Yii::t('app', 'Kopeeri'), ['copy', 'id' => $m->id], ['class' => 'btn btn-primary']);
			echo '<br>';
		}
		echo $m->mfr.' ';
		echo $m->model.' | ';
		
		if($soodus)
		{
			$price = $m->cut_price;
		}
		else
		{
			$price = $m->price;	
		}
	
		$pfids = array();
		foreach($m->field_type[0] as $ft)
		{
			foreach($m->product_field as $pf)
			{
				for($i = 0; $i < count($m->field); $i++)
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
					if($m->field[$i][0]->getAttribute('type_id') == $ft->getAttribute('id') && $pf->getAttribute('field_id') == $m->field[$i][0]->getAttribute('id'))
					{
						$pfids[] = $pf->getAttribute('id');
						echo $m->field[$i][0]->name.' ';
						echo $m->field[$i][0]->model.' | ';
					}
				}
			}
		}
		echo '<br>';
		echo '<button onclick="AddToComparison('.$m->id.')">Võrdle</button>';
		echo '<button onclick="AddToCart('.$m->id.')">'.$price.'</button>';
		echo '<br><br>';
	} ?>
</div>

<script>
	function AddToCart(id)
	{
		$.ajax({
			url: "/index.php/product/to-cart?id="+id,
		}).done(function(data) {
			$('a[href^="/index.php/cart/index"]').text('Ostukorv('+ data +')');
		});
	}
	function AddToComparison(id)
	{
		$.ajax({
			url: "/index.php/product/to-comparison?id="+id,
		}).done(function(data) {
			$('a[href^="/index.php/comparison/index"]').text('Võrdle('+ data +')');
		});
	}
</script>
