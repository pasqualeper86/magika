<?php

namespace app\controllers;

use Yii;
use app\models\Utenti;
use app\models\UtentiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtentiController implements the CRUD actions for Utenti model.
 */
class UtentiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Utenti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UtentiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Utenti model.
     * @param integer $ID
     * @param integer $tipo_user_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID, $tipo_user_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID, $tipo_user_ID),
        ]);
    }

    /**
     * Creates a new Utenti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Utenti();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'tipo_user_ID' => $model->tipo_user_ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Utenti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID
     * @param integer $tipo_user_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID, $tipo_user_ID)
    {
        $model = $this->findModel($ID, $tipo_user_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'tipo_user_ID' => $model->tipo_user_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Utenti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID
     * @param integer $tipo_user_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID, $tipo_user_ID)
    {
        $this->findModel($ID, $tipo_user_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Utenti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID
     * @param integer $tipo_user_ID
     * @return Utenti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $tipo_user_ID)
    {
        if (($model = Utenti::findOne(['ID' => $ID, 'tipo_user_ID' => $tipo_user_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
