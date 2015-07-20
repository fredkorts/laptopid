<?php

namespace app\controllers;
use Yii;
use app\models\Field;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

class FieldController extends \yii\web\Controller
{
	/*public function behaviors() {
		return ArrayHelper::merge(parent::behaviors(), [
					'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
							'delete' => ['post'],
						],
					],
		]);
	}*/
		/*public function behaviors() {
		return ArrayHelper::merge(parent::behaviors(), [
					'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
							'get-fields-by-type' => ['get'],
						],
					],
		]);
	}*/
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionView()
    {
        return $this->render('view');
    }

	public function actionGetFieldsByType()
	{
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$fields = Field::find()->where(['type_id' => $id])->all();
		\Yii::$app->response->format = 'json';
		
		/*
		var komponendid = [
		   { value: 'Intel', data: '1' },
		   { value: 'Kingston', data: '2' },
		   { value: 'Nvidia', data: '3' }
		];
		*/
		
		/*foreach($fields as $f)
		{
			$array[] = "{ value: '".$f->getAttribute('name')."', data: '".$f->getAttribute('id')."' }";
		}*/
		return $fields;
	}
}
