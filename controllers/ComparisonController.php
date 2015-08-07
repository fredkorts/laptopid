<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Product;
use comparison\comparison\Comparison;

class ComparisonController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	
    public function actionIndex()
    {
        return $this->render('index');
	}
	
	public function actionRemoveFromComparison($id)
	{
		$comparison = \Yii::$app->comparison;
		$comparison->remove($id);
		
        return $this->render('/comparison/index');
	}
}