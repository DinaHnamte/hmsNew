<?php

namespace common\modules\vitalsigns\controllers;

use common\models\VitalSign;
use common\models\Encounter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PcsIndexController implements the CRUD actions for PcsIndex model.
 */
class VitalSignController extends Controller
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
     * Lists all PcsIndex models.
     *
     * @return string
     */
    public function actionIndex($encounter_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => VitalSign::find()->where(['encounter_id' => $encounter_id,
            'pat_id' => $encounter->pat_id]),              
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetVitalSigns($encounter_id)
    {
        $encounter = Encounter::findOne($encounter_id);
        $dataProvider = new ActiveDataProvider([
            'query' => VitalSign::find()->where(['encounter_id' => $encounter->id,
            'pat_id' => $encounter->pat_id]),            
        ]);
          
        return $this->render('get-vital-signs', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PcsIndex model.
     * @param string $id ID
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
     * Creates a new PcsIndex model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($encounter_id)
    {
        $model = new VitalSign();
        $encounter = Encounter::findOne($encounter_id);
        if ($this->request->isPost) {
            if($this->request->post('action')==='delete'){
                $id = $this->request->post('id');
                VitalSign::findOne($id)->delete();
            }else{
                if ($model->load($this->request->post()) && $model->save()) {
                    //return 'ok';
                }
            }
            
        } else {
            $model->loadDefaultValues();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => VitalSign::find()->where(['encounter_id' => $encounter_id,
            'pat_id' => $encounter->pat_id]),            
        ]);

        $model->pat_id = $encounter->pat_id;
        $model->encounter_id = $encounter->id;
        return $this->renderAjax('create', [
            'model' => $model, 'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Updates an existing PcsIndex model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
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
     * Deletes an existing PcsIndex model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return 'ok';
    }

    /**
     * Finds the PcsIndex model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return PcsIndex the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VitalSign::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
