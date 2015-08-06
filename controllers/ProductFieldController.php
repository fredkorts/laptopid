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
		$data = Yii::$app->request->post();
		$field_id = intval($data['field_id']);
		$product_id = intval($data['product_id']);
        $model = new ProductField();
		$id = intval(Yii::$app->getRequest()->getQueryParam('id'));
		if($id <= 0)
		{
			$id = $product_id;
		}
		
        if($field_id > 0 && $product_id > 0) {
			$url = '/index.php/product/update/'.$id;
			$model->setAttribute("field_id", $field_id);
			$model->setAttribute("product_id", $product_id);
			$model->save();
        }
		
		return $this->redirect($url); 
    }
	
    public function actionDelete($id)
    {
		$url = '';
		$product_field = ProductField::findOne($id);
		$product_id = $product_field->getAttribute('product_id');
		
		$this->findModel($id)->delete();
		$url = '/index.php/product/update/'.$product_id;
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
		$data = Yii::$app->request->post();
		$model = $this->findModel($data['id']);
		$id = intval($data['id']);
		$field_id = intval($data['field_id']);
		$product_id = intval($data['product_id']);
		$pid = intval(Yii::$app->getRequest()->getQueryParam('id'));
		if($pid <= 0)
		{
			$pid = $product_id;
		}
		
        if($id > 0 && $field_id > 0 && $product_id > 0) {
			$model->setAttribute('field_id', $field_id);
			$model->save();
        }
		return $this->redirect(['/product/update/'.$pid]);
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
