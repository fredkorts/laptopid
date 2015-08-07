<?php
use yii\helpers\Html;

$items = \Yii::$app->cart->getItems();
//var_dump($items);
foreach($items as $i)
{
	echo $i->getAttribute('mfr').' '.$i->getAttribute('model').' ';
	echo $i->getAttribute('price');
	echo Html::a(Yii::t('app', "Eemalda"), ['remove-from-cart', 'id' => $i->getUniqueId()], ['class' => 'btn btn-primary']);
	echo '<br>';
}
?>