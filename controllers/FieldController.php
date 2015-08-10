<?php

namespace app\controllers;

use Yii;
use app\models\Field;
use app\models\FieldSearch;
use app\models\FieldType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FieldController implements the CRUD actions for Field model.
 */
class FieldController extends Controller
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
     * Lists all Field models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FieldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Field model.
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
     * Creates a new Field model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(!$this->IsAdmin())
		{
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Puuduvad piisavad õigused.']);
		}
        $model = new Field();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Field model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(!$this->IsAdmin())
		{
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Puuduvad piisavad õigused.']);
		}
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
     * Deletes an existing Field model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(!$this->IsAdmin())
		{
			return $this->render('error', ['name' => 'Not Found (#404)', 'message' => 'Puuduvad piisavad õigused.']);
		}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
    public function actionGetname($id)
    {
		$ft = FieldType::findOne($id);
		$name = $ft->name;
        return $name;
    }
	
    /**
     * Finds the Field model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Field the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Field::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
<<<<<<< HEAD

	public function actionGetFieldsByType()
	{
		$id = Yii::$app->getRequest()->getQueryParam('id');
		$fields = Field::find()->where(['type_id' => $id])->all();
		\Yii::$app->response->format = 'json';
		return $fields;
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
=======
>>>>>>> Zbit_laptopid/master
}
