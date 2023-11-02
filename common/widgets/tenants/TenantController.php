<?php

namespace app\controllers;

use YII;
use yii\helpers\Json;
use app\models\Hsp;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HspController implements the CRUD actions for Hsp model.
 */
class TenantController extends Controller
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
     * Lists all Hsp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Hsp::find(),            
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

            
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single reguser model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Hsp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    
    public function actionCreate()
    {
        $model = new Hsp();
		
        if($this->request->isPost){
			if ($model->load(Yii::$app->request->post())) {
                $model->regby_id = Yii::$app->user->identity->id;
                $model->id = uniqid();
                $authMngr = Yii::$app->authManager;
                if($authMngr->getAssignment('hsp_admin', Yii::$app->user->identity->id) == null){
                    $role = $authMngr->getRole('hsp_admin');
                    $authMngr->assign($role, Yii::$app->user->identity->id);
                }	
				
                if($model->save()){
                    return Json::encode(['success' => true,'data' => '',
                            'message' => 'Done.',
                        ]);
                }else{
                    return Json::encode(['success' => false,'data' => '',
                                'message' => 'Please check your entry and try again.',
                            ]);
                }				
			}			
			
		}
		//$model->pix = false;
        $model->id = uniqid();
        $model->regby_id = Yii::$app->user->identity->id;
        $model->status = 1;
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Hsp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if ($model->load(Yii::$app->request->post())) {
                if($model->save()){
                    return Json::encode(['success' => true,'data' => '',
                        'message' => 'Done.',
                    ]);
                }else{
                    return Json::encode(['success' => false,'data' => '',
                        'message' => 'Please check your entry and try again.',
                    ]);
                }
            }
        }
        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hsp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hsp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Hsp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hsp::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
