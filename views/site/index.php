<?php
use yii\helpers\Html;
$this->title = 'Soodsad sülearvutid';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="body-content">
		<?php foreach($model as $m)
		{
			echo 'Tootja: '.$m->getAttribute('mfr').'<br>';
			echo 'Mudel: '.$m->getAttribute('model').'<br>';
			echo 'Hind: '.$m->getAttribute('price').'<br>';
			echo 'Soodushind: '.$m->getAttribute('cut_price').'<br>';
			echo 'Stock: '.$m->getAttribute('stock').'<br>';
			echo 'Info: '.$m->getAttribute('description').'<br><br>';
			
			for($i = 0; $i < count($m->field); $i++)
			{
				for($t = 0; $t < count($m->field_type); $t++)
				{
					if($m->field_type[$t][0]->getAttribute('id') == $m->field[$i][0]->getAttribute('type_id'))
					{
						echo $m->field_type[$t][0]->getAttribute('name').': ';
					}
				}
				echo $m->field[$i][0]->getAttribute('name').' ';
				echo $m->field[$i][0]->getAttribute('model').'<br>';
			}
			if(!Yii::$app->user->isGuest) {
				echo '<a href="/index.php/product/kopeeri/'.$m->getAttribute('id').'">Kopeeri toode</a>';
			}
			echo '<br><br>';
		}?>

    </div>
</div>
