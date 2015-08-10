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
		if(!$this->IsAdmin())
		{
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Puuduvad piisavad õigused.']);
		}
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
	
	public function IsAdmin()
	{
		$identity = Yii::$app->user->identity;
		$is_admin = false;
		if(isset($identity))
		{
			$is_admin = $identity->isAdmin;	
		}
		return $is_admin;
	}
}
