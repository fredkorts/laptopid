<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Product;
use yii2mod\cart\Cart;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class CartController extends Controller
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
	
	public function actionRemoveFromCart($id)
	{
		$cart = \Yii::$app->cart;
		$cart->remove($id);
		
        return $this->render('/cart/index');
	}
}