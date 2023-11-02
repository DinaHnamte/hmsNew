<?php

namespace common\modules\auth\controllers;

use YII;
use common\models\auth\AuthRole;
use common\models\auth\AuthAssignment;
use common\models\auth\Tenant;
use common\models\auth\RegUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HspController implements the CRUD actions for Hsp model.
 */
class RegisterController extends Controller
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
        return $this->goHome();
    }

    
    /**
     * Creates a new Hsp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    
    public function actionRegisterTenant()
    {
        $model = new Tenant();
		
        if($this->request->isPost){
			if ($model->load(Yii::$app->request->post())) {
                $count = Tenant::find()->where(['name' => $model->name])->count();
                if($count==0){
                $model->regby_id = Yii::$app->user->identity->id;
                $model->id = uniqid();
                $dt = time();
                $model->created_at = $dt;
                $model->updated_at = $dt;
                    if($model->save()){
                        $role = AuthRole::getRole('Admin',$model -> app_id);
                        AuthAssignment::assignRole($role->id, $model->regby_id, $model->id);
                        Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                        return $this->goHome();
                    }                			
			    }	
                Yii::$app->session->setFlash('error', 'Name already exist.');
                return $this->goHome();
            }			
		}
		
        $model->id = uniqid();
        $model->regby_id = Yii::$app->user->identity->id;
        $model->status = 1;
        $model->app_id = $this->request->get('app_id');
        return $this->render('register-tenant', [
            'model' => $model,
        ]);
    }


    /**
     * Creates a new reguser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateRegUser()
    {
        $model = new RegUser();

        $reguser = RegUser::find()->where(['id' => $this->request->get('id')])->one();
        if($reguser){
            return $this->redirect(['/auth/site/login']);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $dt = time();
                $model->created_at = $dt;
                $model->updated_at = $dt;
                $model->save();
                $user = User::findOne(['id' => $model->id]);
                $user->status = User::STATUS_ACTIVE;
                if($user->save()){
                    $role = AuthRole::getRole('User',0);
                    AuthAssignment::assignRole($role->id, $user->id, 0);
                    Yii::$app->user->login($user, true ? 3600*24*30 : 0);
                    return $this->goHome();
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        $model->id = $this->request->get('id');
        
        return $this->render('create-reg-user', [
            'model' => $model,
        ]);
    }
}
