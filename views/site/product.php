<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	<?php //var_dump($model); ?>
		<?php foreach($model as $m)
		{
			echo 'Tootja: '.$m->getAttribute('mfr').'<br>';
			echo 'Mudel: '.$m->getAttribute('model').'<br>';
			echo 'Hind: '.$m->getAttribute('price').'<br>';
			echo 'Soodushind: '.$m->getAttribute('cut_price').'<br>';
			echo 'Stock: '.$m->getAttribute('stock').'<br>';
			echo 'Active: '.$m->getAttribute('active').'<br>';
			echo 'Info: '.$m->getAttribute('description').'<br><br>';
		}?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
