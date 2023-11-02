<?php

namespace admin\controllers;

use Yii;
use common\models\auth\RegUser;
use common\models\auth\User;
use common\models\auth\Tenant;
use common\models\TenantApp;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii2mod\rbac\models\AssignmentModel;
use common\models\auth\AuthAssignment;
use common\models\auth\AuthRole;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * Class ItemController
 *
 * @package yii2mod\rbac\base
 */
class DefaultController extends Controller
{
    public $defaultAction = 'index';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [],
                ],
            ]
        );
    }

    /**
     * Lists of all auth items
     *
     * @return mixed
     */
    public function actionIndex()
    {
      return $this->render('index');
    }

    public function actionTenantIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tenant::find()->where(['status' => 1]),            
            'pagination' => [
                'pageSize' => 10
            ],            
        ]);

        return $this->render('tenant-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionXtenantIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tenant::find()->where(['status' => 0]),            
            'pagination' => [
                'pageSize' => 10
            ],            
        ]);

        return $this->render('xtenant-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproveTenantView($id)
    {
        $model = Tenant::find()->where(['id' =>$id])->with('regUser')->one();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->status = 1;            
            if($model->save()){
                $ta = new TenantApp();
                $ta->app_id = $model->app_id;
                $ta->tenant_id = $model->id;
                $ta->save();
                if($ta->save()){
                    $role = AuthRole::getRole('Admin',$model->app_id);
                    AuthAssignment::assignRole($role->id, $model->regby_id, $model->id);
                    return "ok";
                }                
            }            
        }
        return $this->renderAjax( 'approve-tenant-view', [
            'model' => $model,
        ]);
    }

    public function actionTenantView($id)
    {
        $model = Tenant::findOne([$id]);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->status = 0;
            if($model->save()){
                $count = AuthAssignment::find()->where(['tenant_id' => $model->id])->count();
                if($count>0){
                    AuthAssignment::deleteAll(['tenant_id' => $model->id]);
                    $x = TenantApp::find()->where(['tenant_id' => $model->id])->count();
                    if($x>0){
                        TenantApp::deleteAll(['tenant_id' => $model->id]);
                        return 'ok';
                    } 
                } 
            }
        }
        return $this->renderAjax('tenant-view', [
            'model' => $model,
        ]);
    }

    public function actionGetAdmins()
    {
        $role = AuthRole::getRole('Admin',Yii::$app->id);
        $dataProvider = new ActiveDataProvider([
            'query' => AuthAssignment::find()->where(['role_id' => $role->id]),            
            'pagination' => [
                'pageSize' => 10
            ],            
        ]);

        return $this->render('get-admins', [
            'dataProvider' => $dataProvider,
        ]);
    }
    

    public function actionCreateAdmin()
    {
        $model = new RegUser();
        $enablebtn = false;
        if ($this->request->isPost) { 
            if($this->request->post('search')=='search'){
                $email = $this->request->post('txtemail');
                $mdl = User::findByUsername($email);
                $role = AuthRole::find()->where(['name' => 'Admin', 'app_id' => Yii::$app->id])->one();
                $x = AuthAssignment::find()->where(['role_id' => $role->id, 'user_id' => $mdl->id])->count();
                if($x>0){
                    $enablebtn = false;                    
                }
                $enablebtn = true;
                $model = $mdl->regUser;
            }else{
                $user_id = $this->request->post('user_id'); 
                $role = AuthRole::getRole('Admin',Yii::$app->id);
                if(AuthAssignment::assignRole($role->id, $user_id, Yii::$app->id)){
                    return 'ok';
                }               
                return 'error';
            }   
        }
        
        return $this->renderAjax('create-admin', [
            'model' => $model, 'enablebtn' => $enablebtn
        ]);
    }

    public function actionRemoveAdmin()
    {        
        $model = new RegUser();        
        if ($this->request->isPost) {       
            $model->load($this->request->post());
            $role = AuthRole::getRole('Admin','ADMIN');           
            $authMdl = AuthAssignment::find()->where([
                'role_id' => $role->id, 'user_id' => $model->id, 'tenant_id' => 0])
                        ->one();
            $authMdl->delete();
            return 'ok';
        }
        $user_id = $this->request->get('user_id');
        $model = RegUser::findOne($user_id);
        return $this->renderAjax('remove-admin', [
            'model' => $model,
        ]);
    }

    public function actionGetRoles()
    {   
        $id = $this->request->get("id");
        $dataProvider = new ActiveDataProvider([
            'query' => AuthRole::find(),            
            'pagination' => [
                'pageSize' => 10
            ],            
        ]);
        // $authMnger = Yii:: $app->authManager;
        // $provider = new ArrayDataProvider([
        // 'allModels' => $authMnger->getRoles(),
        // ]);

        return $this->render('get-roles', [
            'dataProvider' => $dataProvider,
        ]);
      return $this->render('get-roles');
    }

    public function actionCreateRole()
    {
        $model = new AuthRole();
               
        if ($this->request->isPost) {
            $model->load($this->request->post());           
          
        if(AuthRole::createRole($model->name, $model -> app_id, $model->description)){
            return 'ok';            
          }
          return 'Role already exist';          
        }

        return $this->renderAjax('create-role',['model' => $model]);
    }

    public function actionViewRole(){
      $users = new ArrayDataProvider([
        'allModels' => RegUser::find()->all(),
      ]);
      return $this->render('view-role', [
        'dataProvider' => $users,
      ]);
    }

    public function actionDelete(){
          $id = $this->request->get("id");
          AuthRole::removeRole($id);
          return $this->redirect('get-roles');
    }
      

    public function actionAssignRole(int $id){
        $model = $this->findModel($id);
        $user = RegUser::findOne($id);
        return $this->render('assign-role', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Assign items
     *
     * @param int $id
     *
     * @return array
     */
    public function actionAssignRoleitem(int $id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $assignmentModel = $this->findModel($id);
        $assignmentModel->assign($items);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $assignmentModel->getItems();
    }

    /**
     * Remove items
     *
     * @param int $id
     *
     * @return array
     */
    public function actionRemoveRoleitem(int $id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $assignmentModel = $this->findModel($id);
        $assignmentModel->revoke($items);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $assignmentModel->getItems();
    }

    protected function findModel(int $id)
    {
        $class =  Yii::$app->user->identityClass;

        if (($user = $class::findIdentity($id)) !== null) {
            return new AssignmentModel($user);
        }

        throw new NotFoundHttpException(Yii::t('yii2mod.rbac', 'The requested page does not exist.'));
    }
}
