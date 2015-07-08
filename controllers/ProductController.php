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
			foreach($models as $model)
			{
				$product_fields = ProductField::find()->where(['product_id' => $model->getAttribute('id')])->all();
				foreach ($product_fields as $pf) {
					$field = Field::find()->where(['id' => $pf->getAttribute('field_id')])->all();
					$model->field[] = $field;
					foreach ($field as $f) {
						$field_type = FieldType::find()->where(['id' => $f->getAttribute('type_id')])->all();
						$model->field_type[] = $field_type;
					}
				}
				$model->product_field = $product_fields;
			}
		}
		else
		{	
			$models = Product::find()->where(['>', 'cut_price', 0])->all();
			foreach($models as $model)
			{
				$product_fields = ProductField::find()->where(['product_id' => $model->getAttribute('id')])->all();
				foreach ($product_fields as $pf) {
					$field = Field::find()->where(['id' => $pf->getAttribute('field_id')])->all();
					$model->field[] = $field;
					foreach ($field as $f) {
						$field_type = FieldType::find()->where(['id' => $f->getAttribute('type_id')])->all();
						$model->field_type[] = $field_type;
					}
				}
				$model->product_field = $product_fields;
			}
		}

        return $this->render('index', [
            'models' => $models,
        ]);
    }

	public function actionUpdateProductField()
	{
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$model = ProductField::findOne($id);
		return $this->render('/product-field/update', [
            'model' => $model,
        ]);
	}

	public function actionCreateProductField()
	{
        $model = new ProductField();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/product-field/create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
            return $this->redirect(['view', 'id' => $model->id]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
