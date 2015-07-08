<?php

namespace app\controllers;
use Yii;
use app\models\Product;
use app\models\LoginForm;
use app\models\Page;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SiteController extends \yii\web\Controller
{
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
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['>', 'cut_price', '0']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
        return $this->render('list');
    }
	
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
