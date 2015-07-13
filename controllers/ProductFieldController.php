<?php

namespace app\controllers;
use Yii;
use app\models\ProductField;
use app\models\Product;
use app\models\Field;
use app\models\FieldType;

class ProductFieldController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new ProductField();
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$model->product_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
    public function actionDelete($id)
    {
		$url = '';
		$product_field = ProductField::findOne($id);
		$product_id = $product_field->getAttribute('product_id');
				
		$this->findModel($id)->delete();
		$url = '/index.php/product-field/create/'.$product_id;		
		
		return $this->redirect($url); 
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
	
    public function actionUpdate($id)
    {
		$product_field = ProductField::findOne($id);
		$product_id = $product_field->getAttribute('product_id');
		$url = '/index.php/product-field/create/'.$product_id;
		$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($url);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    protected function findModel($id)
    {
        if (($model = ProductField::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
