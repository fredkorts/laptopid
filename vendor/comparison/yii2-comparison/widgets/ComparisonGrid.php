<?php
namespace comparison\comparison\widgets;

use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use comparison\comparison\Comparison;

class ComparisonGrid extends Widget
{
    public $comparisonDataProvider;
    public $comparisonColumns = [
        'id',
        'label',
    ];
    public $gridOptions = [];
    public $itemType = Comparison::ITEM_PRODUCT;

    public function init()
    {
        $comparison = \Yii::$app->get('comparison');

        if (!isset($this->comparisonDataProvider)) {
            $this->comparisonDataProvider = new ArrayDataProvider([
                'allModels' => $comparison->getItems($this->itemType),
                'pagination' => false,
            ]);
        }
    }

    public function run()
    {
        return $this->render('comparison', [
            'gridOptions' => $this->getGridOptions(),
        ]);
    }

    public function getGridOptions()
    {
        return ArrayHelper::merge($this->gridOptions, [
            'dataProvider' => $this->comparisonDataProvider,
            'columns' => $this->comparisonColumns
        ]);
    }
}
