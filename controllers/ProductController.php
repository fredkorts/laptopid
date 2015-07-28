<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductField;
use app\models\Field;
use app\models\FieldType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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

    /**
     * Lists all Product models.
     * @return mixed
     */ 
    public function actionIndex()
    {
		if(Yii::$app->getRequest()->getPathInfo() == 'product')
		{
			$models = Product::find()->where(['=', 'cut_price', 0])->all();
		}
		else
		{	
			$models = Product::find()->where(['>', 'cut_price', 0])->all();
		}
		foreach($models as $model)
		{
			$model->product_field = ProductField::find()->where(['product_id' => $model->getAttribute('id')])->all();			
			$model->field_type[] = FieldType::find()->orderBy('order_by')->all();
			foreach ($model->product_field as $pf) {
				$field = Field::find()->where(['id' => $pf->getAttribute('field_id')])->all();
				$model->field[] = $field;
			}
		}

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
			$model->setAttribute('mfr', '-');
			$model->setAttribute('model', '-');
			$model->setAttribute('description', '-');
			$model->setAttribute('price', 0);
			$model->setAttribute('stock', 0);
			$model->setAttribute('active', 0);
			$model->setAttribute('highlighted', 0);
		$model->save();
		
		return $this->redirect(['update', 'id' => $model->id]);

    }
	
	public function actionCreateCut()
	{
       $model = new Product();
			$model->setAttribute('mfr', '0');
			$model->setAttribute('model', '0');
			$model->setAttribute('description', '0');
			$model->setAttribute('price', 0);
			$model->setAttribute('stock', 0);
			$model->setAttribute('active', 0);
			$model->setAttribute('highlighted', 0);
		$model->save();
		
		return $this->redirect(['update', 'id' => $model->id]);
	
	}

	public function actionCopy()
    {
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$product = Product::findOne($id);
		$product_field = ProductField::find()->where(['product_id' => $id])->all();
	
		$new_product = new Product();
		$new_product->setAttribute('mfr', $product->getAttribute('mfr'));
		$new_product->setAttribute('model', $product->getAttribute('model'));
		$new_product->setAttribute('price', $product->getAttribute('price'));
		$new_product->setAttribute('cut_price', $product->getAttribute('cut_price'));
		$new_product->setAttribute('stock', $product->getAttribute('stock'));
		$new_product->setAttribute('active', $product->getAttribute('active'));
		$new_product->setAttribute('description', $product->getAttribute('description'));
		$new_product->save();
		
		foreach($product_field as $pf) {
			$new_product_field = new ProductField();
			$new_product_field->setAttribute('product_id', $new_product->getAttribute('id'));
			$new_product_field->setAttribute('field_id', $pf->getAttribute('field_id'));
			$new_product_field->save(false);
		}
		
		if($product->getAttribute('cut_price')==0){
			$produktid = Product::find()->where(['active' => 1])->andWhere(['<=', 'cut_price', '0'])->all();
		} else {
			$produktid = Product::find()->where(['active' => 1])->andWhere(['>=', 'cut_price', '1'])->all();
		}
		
		if($produktid == null)
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Page not found.']);
			
		foreach ($produktid as $p) {
			$product_fields = ProductField::find()->where(['product_id' => $p->getAttribute('id')])->all();
			foreach ($product_fields as $pf) {
				$field = Field::find()->where(['id' => $pf->getAttribute('field_id')])->all();
				$p->field[] = $field;
				foreach ($field as $f) {
					$field_type = FieldType::find()->where(['id' => $f->getAttribute('type_id')])->all();
					$p->field_type[] = $field_type;
				}
			}
			$p->product_field = $product_fields;
		}
		
		if($product->cut_price > 0){
			return $this->redirect(['index']);
		} else {
			return $this->redirect(['/product']);
		}
    }
	
    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$product = Product::findOne($id);
        if($product->cut_price > 0){
			$this->findModel($id)->delete();			
			return $this->redirect(['index']);
		} else {		
			$this->findModel($id)->delete();		
			return $this->redirect(['/product']);
		}
    }
	
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionGetfieldname($id)
	{
		$field = Field::find()->where(['id' => $id])->one();
		if($field)
		{
			return $field->getAttribute('name').' '.$field->getAttribute('model').' '.$field->getAttribute('value');
		}
		return "";
	}
	 
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
