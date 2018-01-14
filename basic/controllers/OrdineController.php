<?php

namespace app\controllers;

use Yii;
use app\models\Ordine;
use app\models\OrdineSearch;
use app\models\Articolo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


/**
 * OrdineController implements the CRUD actions for Ordine model.
 */
class OrdineController extends Controller
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
     * Lists all Ordine models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new OrdineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('test', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/
        public function actionIndex()
    {
        // your default model and dataProvider generated by gii
        $searchModel = new OrdineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $ordineId = Yii::$app->request->post('editableKey');
            $model = Ordine::findOne($ordineId);

            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);
          
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['Ordine']);
            $post = ['Ordine' => $posted];

            // load model like any single model validation
            if ($model->load($post)) {
            // can save model or do something before saving model
            $model->save();

            // custom output to return to be displayed as the editable grid cell
            // data. Normally this is empty - whereby whatever value is edited by
            // in the input by user is updated automatically.
            $output = '';

            // specific use case where you need to validate a specific
            // editable column posted when you have more than one
            // EditableColumn in the grid view. We evaluate here a
            // check to see if buy_amount was posted for the Book model
            if (isset($posted['buy_amount'])) {
            $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
            }

            // similarly you can check if the name attribute was posted as well
            // if (isset($posted['name'])) {
            // $output = ''; // process as you need
            // }
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }

        // non-ajax - render the grid by default
        return $this->render('test', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Ordine model.
     * @param integer $id
     * @param integer $cliente
     * @param integer $stato
     * @param integer $agente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $cliente, $stato, $agente)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $cliente, $stato, $agente),
        ]);
    }

    /**
     * Creates a new Ordine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   public function actionCreate()
    {
        $modelCustomer = new Ordine;
        $modelsAddress = [new Articolo];
        if ($modelCustomer->load(Yii::$app->request->post())) {
            $modelsAddress = Model::createMultiple(Articolo::classname());
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAddress),
                    ActiveForm::validate($modelCustomer)
                );
            }

            // validate all models
            $valid = $modelCustomer->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;
            
            if (1) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->ordine_id = $modelCustomer->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['ordine/index', 'id' => $modelCustomer->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Articolo] : $modelsAddress
        ]);
    }

    /**
     * Updates an existing Ordine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $cliente
     * @param integer $stato
     * @param integer $agente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $cliente, $stato, $agente)
    {
        $model = $this->findModel($id, $cliente, $stato, $agente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'cliente' => $model->cliente, 'stato' => $model->stato, 'agente' => $model->agente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ordine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $cliente
     * @param integer $stato
     * @param integer $agente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $cliente, $stato, $agente)
    {
        $this->findModel($id, $cliente, $stato, $agente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ordine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $cliente
     * @param integer $stato
     * @param integer $agente
     * @return Ordine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $cliente, $stato, $agente)
    {
        if (($model = Ordine::findOne(['id' => $id, 'cliente' => $cliente, 'stato' => $stato, 'agente' => $agente])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}