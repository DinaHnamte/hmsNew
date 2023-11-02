<?php

namespace common\modules\patient\controllers;

use common\models\Encounter;
use Yii;
use yii\helpers\Json;
use common\models\OpdReg;
use common\models\auth\RegUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\auth\Tenant;
/**
 * PatientController implements the CRUD actions for OpdReg model.
 */
class PatientController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all OpdReg models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $tenant_id = '';
        if($this->request->get('id')){
            $tenant_id = $this->request->get('id');
        }else{
            return $this->redirect(['select-hsp']);
        }
        $hspModel = Tenant::findOne($tenant_id);
        $model = new Encounter();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $id = '';
                for ($x = 0; $x <= 10; $x++) {
                    $id =  uniqid();
                    $c = $model->find()->where(['id' => $id])->select('id')->count();
                    if($c == 0){
                        break;
                    }
                }
                $model->id = $id;
                $model->registered_at = time();
                $model->save();
                return "ok";
            }
        } else {
            $model->loadDefaultValues();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Encounter::find()->where(['pat_id' => Yii::$app->user->identity->id])
                        ->with('tenant'),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $model->hsp_id = $tenant_id;
        $model->encounter_type = 'OPD';
        $model->pat_id = Yii::$app->user->identity->id;
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider, 'hspModel' => $hspModel,
        ]);
    }

    public function actionSelectHsp()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Tenant::find()->where(['type' => "hospital"]),
        ]);

        
        return $this->render('select-hsp', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single OpdReg model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   
    /**
     * Creates a new OpdReg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Encounter();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->registered_at = time();
                $model->save();
                return "done";
            }
        } else {
            $model->loadDefaultValues();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Encounter::find()->where(['pat_id' => Yii::$app->user->identity->id, 'hsp_id' => $this->request->get('hsp_id')]),
            'sort' => [
                'defaultOrder' => [
                    'session_end_at' => SORT_ASC,
                ]
            ],
        ]);

        $model->hsp_id = $this->request->get('hsp_id');
        $model->encounter_type = 'OPD';
        $model->pat_id = Yii::$app->user->identity->id;
        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Updates an existing OpdReg model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OpdReg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $id = $this->request->post("id");
        $delete_res = $this->findModel($id)->delete();
        if($delete_res){
            return true;
        }else{
            return false;
        }  
    }

    /**
     * Finds the OpdReg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OpdReg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encounter::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
