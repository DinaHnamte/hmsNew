<?php

namespace hospital\controllers;

use app\models\Tenant;
use yii;
use app\models\RegUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\rbac\DbManager;


/**
 * ReguserController implements the CRUD actions for reguser model.
 */
class ReguserController extends Controller
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
     * Lists all reguser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => reguser::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new reguser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RegUser();

        $reguser = RegUser::find()->where(['user_id' => $this->request->get('id')])->one();
        if($reguser){
            return $this->redirect(['site/login']);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $dt = time();
                $model->created_at = $dt;
                $model->updated_at = $dt;
                $model->save();
                $user = User::findOne(['id' => $model->user_id]);
                $user->status = User::STATUS_ACTIVE;
                $user->save(false);
                
                $auth = Yii::$app->authManager;

                if ($auth->getAssignment('user',$user->id)==null) {				
                    $role = $auth->getRole('user');
                    $auth->assign($role, $user->id);
                    Yii::$app->session->setFlash('success', ' The User is now Course Admin.');

                    $Tenant_name = Tenant::find()->where(['regby_id' => $user->id])->select('name');
                    Yii::$app->cookieManager->setcookie('user_data', ['id' => $user->id, 'Tenant' => $Tenant_name]);

                    Yii::$app->user->login($user, true ? 3600*24*30 : 0);
                    return $this->redirect(['index']);
                } 
                    
                return $this->redirect(['site/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        $model->user_id = $this->request->get('id');

        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing reguser model.
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
     * Deletes an existing reguser model.
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
     * Finds the reguser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return reguser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = reguser::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
