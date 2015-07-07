<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\ProductField;
use app\models\Field;
use app\models\FieldType;
use app\models\Page;
use app\models\PageEditForm;

class SiteController extends Controller
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
		$produktid = $this->getProducts(1);
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
        return $this->render('index', [ 'model' => $produktid]);
    }
	
	public function getProductField($p)
	{
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
	
    public function actionTooted()
    {	
		$produktid = $this->getProducts();
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
        return $this->render('product', [ 'model' => $produktid]);
    }
	
	public function getProducts($discount = 0)
	{
		if($discount)
		{
			$products = Product::find()->where(['active' => 1])->andWhere(['>=', 'cut_price', '1'])->all();
		}
		else
		{
			$products = Product::find()->with('product_field')->where(['active' => 1, 'cut_price' => 0])->all();
		}
		return $products;
	}

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
