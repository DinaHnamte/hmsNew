<?php

namespace common\modules\usersnroles\controllers;

use Yii;
use common\models\Employee;
use common\models\TenantApp;
use common\models\auth\User;
use common\models\auth\RegUser;
use common\models\auth\AuthAssignment;
use common\models\auth\AuthRole;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\TenantManager;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class RolesController extends Controller
{
    /**
     * {@inheritdoc}
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

    public function actionUserroles()
    {
        $iduser = Yii::$app->request->get('user_id');
        if ($this->request->isPost) {
            $iduser = $this->request->post('user_id');
            $authId = $this->request->post('id');
            $model = AuthAssignment::findOne($authId)->delete();
            Yii::$app->session->setFlash('success', "Role removed successfully.");
        } 
        $dataProvider = new ActiveDataProvider([
            'query' => AuthAssignment::find()->where(['user_id' => $iduser,
                        'tenant_id' =>  TenantManager::getTenantId()]),
        ]);

        return $this->render('userroles', [
            'dataProvider' => $dataProvider, 'regUser' => RegUser::findOne($iduser)
        ]);
    }

    public function actionDelUserRole($user_id)
    {        
        if ($this->request->isPost) {
            $user_id = $this->request->post('user_id');
            $id = $this->request->post('id');
            
        } 
        $dataProvider = new ActiveDataProvider([
            'query' => AuthAssignment::find()->where(['user_id' => $user_id,
                        'tenant_id' =>  TenantManager::getTenantId()]),
        ]);

        return $this->render('userroles', [
            'dataProvider' => $dataProvider, 'regUser' => RegUser::findOne($user_id)
        ]);
    }

    public function actionAssignUserRole($user_id)
    {        
        if ($this->request->isPost) {
            $user_id = $this->request->post('user_id');
            $id = $this->request->post('id');
            $role = AuthRole::findOne($id);
            $count = AuthAssignment::find()->where(['role_id' => $role->id, 'user_id' => $user_id, 
                        'tenant_id' => TenantManager::getTenantId()])->count();
            if($count==0){                
                if(AuthAssignment::assignRole($role->id, $user_id, TenantManager::getTenantId())){
                    Yii::$app->session->setFlash('success', "Role assigned successfully.");
                } 
            }
        } 
        $t_id = TenantManager::getTenantId();
        $ids = AuthAssignment::find()->where(['user_id' => $user_id,
                        'tenant_id' =>  $t_id])->select(['role_id as id'])->all();
        $tenantapp = TenantApp::find()->where(['tenant_id' => $t_id, 'app_id' => Yii::$app->id ])
                       ->select(['app_id'])->all();
        $query = AuthRole::find()->where(['not in', 'id', $ids])
                            ->andWhere(['in', 'app_id', $tenantapp]);
        //$query = AuthRole::find()->where(['app_id'=> Yii::$app->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('assign-user-role', [
            'dataProvider' => $dataProvider, 'regUser' => RegUser::findOne($user_id)
        ]);
    }

    public function actionGetRoles()
    {   
        $id = $this->request->get("id");
        $dataProvider = new ActiveDataProvider([
            'query' => AuthRole::find()->where(['app_id' => Yii::$app->id]),            
            'pagination' => [
                'pageSize' => 10
            ],            
        ]);
        // $authMnger = Yii::$app->authManager;
        // $provider = new ArrayDataProvider([
        // 'allModels' => $authMnger->getRoles(),
        // ]);

        return $this->render('get-roles', [
            'dataProvider' => $dataProvider,
        ]);
      return $this->render('get-roles');
    }

    

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	/**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}
