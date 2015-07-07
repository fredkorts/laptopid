<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\ProductForm;
use app\models\ProductCreateForm;
use app\models\ProductField;
use app\models\ProductFieldForm;
use app\models\Field;
use app\models\FieldType;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		//$model = Product::findOne(1);
		//var_dump($model);
		//die;
		//if($model == null)
		//	return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Page not found.']);
        //return $this->render('product', [ 'model' => $model]);
		return $this->render('index');
    }
	public function actionProductCreate()
	{
		$model = new ProductCreateForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			
			$p = new Product();
			
			$p->setAttribute('mfr', $model->mfr);
			$p->setAttribute('model', $model->model);
			$p->setAttribute('description', $model->description);
			$p->setAttribute('price', $model->price);
			$p->setAttribute('cut_price', $model->cut_price);
			$p->setAttribute('stock', $model->stock);
			$p->setAttribute('active', $model->active);
			$p->setAttribute('highlighted', $model->highlighted);
			
			$p->highlighted=$model->highlighted;
			$p->mfr=$model->mfr;
			$p->active=$model->active;
			$p->stock=$model->stock;
			$p->cut_price=$model->cut_price;
			$p->price=$model->price;
			$p->description=$model->description;
			$p->model=$model->model;
			
			$p->save();
			
			return $this->render('/site/product', ['model' => Product::find()->all()]);			
		} else {
           return $this->render('/site/product-create', ['model' => $model]);
        }
	}
	
    public function actionKopeeri()
    {
		//TODO 5.07.2015 Caupo - Checkida, kas kasutaja on Admin õigustega
		//var_dump(Yii::$app->getRequest()); die;
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$product = Product::findOne($id);
		$product_field = ProductField::find()->where(['product_id' => $id])->all();
		//var_dump($product->getAttribute('mfr'));die;
		$new_product = new Product();
		//$new_product->init();
		$new_product->setAttribute('mfr', $product->getAttribute('mfr'));
		$new_product->setAttribute('model', $product->getAttribute('model'));
		$new_product->setAttribute('price', $product->getAttribute('price'));
		$new_product->setAttribute('cut_price', $product->getAttribute('cut_price'));
		$new_product->setAttribute('stock', $product->getAttribute('stock'));
		$new_product->setAttribute('active', $product->getAttribute('active'));
		$new_product->setAttribute('description', $product->getAttribute('description'));
		$new_product->save(false);
		//var_dump($product);
		//echo "__________________________________";
		//var_dump($new_product);die;
		foreach($product_field as $pf) {
			$new_product_field = new ProductField();
			$new_product_field->setAttribute('product_id', $new_product->getAttribute('id'));
			$new_product_field->setAttribute('field_id', $pf->getAttribute('field_id'));
			$new_product_field->save(false);
		}
		
		//------------------------------------
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
		// TODO 5.07.2015 Caupo - SetFlash, et toode kopeeritud vms...
		
		if($product->getAttribute('cut_price')==0){
			return $this->render('/site/product', [ 'model' => $produktid]);
		}
		return $this->render('/site/index', [ 'model' => $produktid]);
        //return $this->render('/site/index');
    }
	
	public function actionKustuta()
    {
		//TODO 5.07.2015 Caupo - Checkida, kas kasutaja on Admin õigustega
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$product = Product::findOne($id);
				
		Product::deleteAll("id=".$id);
		ProductField::deleteAll("product_id=".$id);
		
		$product_field = ProductField::find()->where(['product_id' => $id])->all();
		//------------------------------------
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
		// TODO 5.07.2015 Caupo - SetFlash, et toode kopeeritud vms...
		
		if($product->getAttribute('cut_price')==0){
			return $this->render('/site/product', [ 'model' => $produktid]);
		}
		return $this->render('/site/index', [ 'model' => $produktid]);
        //return $this->render('/site/index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionKontakt()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('kontakt', [
                'model' => $model,
            ]);
        }
    }
			
	public function actionPage($id)
    {
		$model = Page::findOne($id);
		if($model == null)
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Page not found.']);
		
        return $this->render('page', [
			'model' => $model,
		]);
    }
	
	public function actionEditPage($id)
    {
		$model = Page::findOne($id);
		if($model == null)
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Page not found.']);
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->save();
			return $this->render('page', [
				'model' => $model, 'message' => 'Lehekülg on edukalt muudetud!'
			]);
		} else {
			return $this->render('pageEdit', [
				'model' => $model,
			]);
		}
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionSoodus()
    {
        return $this->render('soodus');
    }

    /*public function actionTooted()
    {
		$model = Product::findOne(1);
		var_dump($model);
		die;
		if($model == null)
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Page not found.']);
        return $this->render('product', [ 'model' => $model]);
        //return $this->render('product');
    }*/

    public function actionKasulikku()
    {
        return $this->render('kasulikku');
    }

    public function actionJarelmaks()
    {
        return $this->render('jarelmaks');
    }

    public function actionRent()
    {
        return $this->render('rent');
    }

    public function actionTeenused()
    {
        return $this->render('teenused');
    }

    public function actionRemont()
    {
        return $this->render('remont');
    }

    public function actionEkraanivahetus()
    {
        return $this->render('ekraanivahetus');
    }

    public function actionBoonused()
    {
        return $this->render('boonused');
    }
}
