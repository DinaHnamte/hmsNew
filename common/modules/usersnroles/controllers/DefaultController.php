<?php

namespace common\modules\usersnroles\controllers;

use common\models\auth\RegUser;
use Yii;
use yii\web\Controller;
use common\models\Employee;
use common\models\Tenant;
use common\models\auth\TenantApp;
use common\models\auth\AuthAssignment;
use common\models\auth\User;
use yii\data\ActiveDataProvider;
use common\components\TenantManager;

/**
 * Default controller for the `modules` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    { 
        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find()->where([
                'tenant_id' => TenantManager::getTenantId()])->with("regUser"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddEmployee(){
        
        $model = new RegUser();
        $showBtn = false; 
        if ($this->request->isPost) {
            $user_id = Yii::$app->request->post('user_id');
            //return $this->redirect(['get-employee-index', 'user_id' => $user_id]);
            if($this->request->post('search')=='search'){
                $email = $this->request->post('txtemail');
                $mdl = User::findByUsername($email);
                if($mdl){
                    $x = Employee::find()->where(['tenant_id' => TenantManager::getTenantId(),
                                         'user_id' => $mdl->id])->count();
                    if($x>0){
                        return 'Already an employee';                   
                    } 
                    $showBtn = true;                   
                    $model = $mdl->regUser;
                }
                
            }else{
                $tenant_id = TenantManager::getTenantId();
                $x = Employee::find()->where(['user_id' => $user_id, 'tenant_id' => $tenant_id])->count();
                if($x>0){
                    return 'Already an employee';
                }
                $reg_user = RegUser::findOne($user_id);
                $emp = new Employee();
                $emp->user_id = $reg_user->id;
                $emp->tenant_id = $tenant_id;
                $emp->status = 1;
                $dt = time();
                $emp->created_at = $dt;
                $emp->updated_at = $dt;
                if($emp->save(false)){                    
                        return 'ok';
                }                               
                return 'Something went wrong';
            }
        }

        return $this->renderAjax('add-employee',[
            'reguserModel' => $model, 'showBtn' => $showBtn
        ]);
    }

    

    public function actionEmployeeDetails(){
        
        $emp_id = Yii::$app->request->get('emp_id');
        $model = Employee::findOne(['id' => $emp_id]);
        
        if ($this->request->isPost) {
            $model = Employee::findOne(['id' => $emp_id]);
            $model->delete();
            $count = AuthAssignment::find()->where(['user_id' => $model->user_id, 
                        'tenant_id' => TenantManager::getTenantId()])->count();
            if($count>0){
                AuthAssignment::deleteAll(['user_id' => $model->user_id, 
                'tenant_id' => TenantManager::getTenantId()]);
            }            
            return 'ok';
        }
        
        return $this->renderAjax('employee-details',['model' => $model, 'reguserModel' => $model->regUser]);
    }    	
		
}
