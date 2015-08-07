<?php
use yii\helpers\Html;

$items = \Yii::$app->comparison->getItems();
//var_dump($items);
foreach($items as $item)
{
	echo $item->getAttribute('mfr').' '.$item->getAttribute('model').' ';
	$pfids = array();
	foreach($item->field_type[0] as $ft)
	{
		echo $ft->getAttribute('name').':<br>';
		foreach($item->product_field as $pf)
		{
			for($i = 0; $i < count($item->field); $i++)
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
				if($item->field[$i][0]->getAttribute('type_id') == $ft->getAttribute('id') && $pf->getAttribute('field_id') == $item->field[$i][0]->getAttribute('id'))
				{
					$pfids[] = $pf->getAttribute('id');
					echo $item->field[$i][0]->name.' ';
					echo $item->field[$i][0]->model.'<br>';
				}
			}
		}	
	}
	echo $item->getAttribute('price');
	echo Html::a(Yii::t('app', "Eemalda"), ['remove-from-comparison', 'id' => $item->getUniqueId()], ['class' => 'btn btn-primary']);
	echo '<br>';
}
?>