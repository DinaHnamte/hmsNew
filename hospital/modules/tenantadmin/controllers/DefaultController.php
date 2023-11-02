<?php

namespace hospital\modules\tenantadmin\controllers;

use common\models\RegUser;
use Yii;
use yii\web\Controller;
use common\models\Employee;
use common\models\auth\AuthAssignment;
use common\models\auth\AuthRole;
use common\models\Tenant;
use common\models\TenantApp;
use common\models\User;
use common\models\Dept;
use common\models\EmployeeDept;
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

        return $this->render('index');
    }

    public function actionGetDoctors()
    {   
        $role = AuthRole::find()->where(['name' => 'Doctor'])->one();
        $qry_in = AuthAssignment::find()->where(['role_id' => $role->id, 
                        'tenant_id' => TenantManager::getTenantId()])
                        ->select('user_id as user_id')->all(); 
        $qry = Employee::find()->where(['in', 'user_id', $qry_in, 
                        'tenant_id' => TenantManager::getTenantId()])->with('regUser', 'empDept');   
        $dataProvider = new ActiveDataProvider([
            'query' => $qry,
        ]);

        return $this->render('get-doctors', [
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Lists all Department models.
     *
     * @return string
     */
    public function actionAssignDept()
    {
        if($this->request->isPost){
            $emp_id = $this->request->post('emp_id');
            $dept_id = $this->request->post('dept_id');
            $tenant_id = TenantManager::getTenantId();
            $count = EmployeeDept::find()->where(['emp_id' => $emp_id, 
                    'dept_id' => $dept_id, 'tenant_id' => $tenant_id
                ])->count();
            if($count==0){
                $emp = Employee::findOne($emp_id);
                $empdept = new EmployeeDept();
                $empdept->emp_id = $emp_id;
                $empdept->user_id = $emp->user_id;
                $empdept->dept_id = $dept_id;
                $empdept->tenant_id = $tenant_id;
                $empdept->save();
                //return $this->redirect(['get-doctors']);
                return 'ok';
            }
            return 'User already assigned to the Dept.';
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Dept::find()->where(['active' => true, 
                        'tenant_id' => TenantManager::getTenantId()]),
            
        ]);
        if($this->request->isAjax){
            return $this->renderAjax('assign-dept', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionRemoveDr()
    {
        if ($this->request->isPost) {            
                $empdept_id = $this->request->post('empdept_id');
                $model = EmployeeDept::findOne($empdept_id);
                $model->delete();
                //return $this->redirect(['get-doctors']);
                return 'ok';            
        }
        $empdept_id = $this->request->get('id');
        
        if($this->request->isAjax){
            return $this->renderAjax('remove-dr', [
                'empdept_id' => $empdept_id,
            ]);
        }
    }
	
}
