<?php

namespace common\modules\encounters\controllers;

use common\models\Encounter;
use yii;
use common\models\auth\User;
use common\models\Dept;
use common\models\EmployeeDept;
use common\models\OpdReg;
use common\models\auth\RegUser;
use DateTime;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\components\TenantManager;

use function PHPUnit\Framework\once;

/**
 * Icd10Controller implements the CRUD actions for Icd10 model.
 */
class DefaultController extends Controller
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
                        //'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $dataProvider = $this->getTodaysPatients();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegisterPatient()
    {
        $model = new Encounter();
        $reguser = new RegUser();
        if ($this->request->isPost) {
            if($this->request->post('txtSearch')){
                $email = $this->request->post('txtSearch');
                $reguser = User::findByUsername($email)->regUser;
            }else{
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
            }            
        } 
        
        $model->hsp_id = TenantManager::getTenantId();
        $model->encounter_type = $this->module->encounterType;
        $model->pat_id = $reguser->id;
        return $this->render('register-patient', [
            'model' => $model, 'regUserModel' => $reguser
        ]);
    }

    public function actionAwaitConsult()
    {

        $dept_id = '#$%';
        if ($this->request->isPost) {
            $dept_id = $this->request->post('dept_id');
        }

        $dateNow = strtotime(date("Y-m-d 00:00:00"));
        $today = date("Y-m-d 00:00:00");
        $a = strtotime(date($today))+86400;
       
        $dataProvider = new ActiveDataProvider([
            'query' => Encounter::find()->where([ 'hsp_id' => TenantManager::getTenantId(),
                        'encounter_type' => $this->module->encounterType, 'ref_dept' => $dept_id,
                        'session_start_at' => 0])
                    ->andWhere(['between', 'registered_at',$dateNow, $a])
                    ->andWhere(['<>', 'reg_fee', 0]),
            ]);
        $depts = Dept::find(['tenant_id' => TenantManager::getTenantId()])->all();
        return $this->render('await-consult', [
            'dataProvider' => $dataProvider, 'depts' => $depts 
        ]);
    }

    public function actionOpdRegister()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Encounter::find()->where([ 'hsp_id' => TenantManager::getTenantId()]),
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            ]);

        return $this->render('opd-register', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPatientdetails(){
        if(!Yii::$app->request->get("idopd")){
            return "no data";
        }
        else{
            $idopd = Yii::$app->request->get('idopd');
            $patientData = new ActiveDataProvider([
                "query" => OpdReg::find()->innerJoinWith('regUser')->where(['opdreg.id' => $idopd]),
            ]);
            return $this->render('patientdetails',['patientData' => $patientData]);
        }
    }

    public function actionUpdatepatient(){
        $idopd =  Yii::$app->request->post("idopd");
        $fee = Yii::$app->request->post("fee");
        $model = OpdReg::find()->where(['id' => $idopd])->one();
        $model->opdfee = $fee;
        $result = $model->update(false);
        if($result > 0){
            return $this->redirect(['patientdetails', 'idopd' => $idopd]);
        }else{
            return "not updated";
        }
        
    }

    public function actionFeePayment($id){
        date_default_timezone_set('Asia/Kolkata');

        // return Yii::$app->formatter->asDatetime($a, 'php:Y-m-d H:i:s');

        // if ($this->request->isPost) {
        //     $pat_id = $this->request->post("pat_id");
        //     $reg_fee = $this->request->post("reg_fee");
        //     $encounter_update = Encounter::findOne($pat_id); 
        //     $encounter_update->counter_at = time();
        //     $encounter_update->reg_fee = $reg_fee;
        //     $update_res = $encounter_update->update(false);
        //     if($update_res){
        //         return;
        //     }
        // }

        $model = Encounter::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->counter_at = time();
            $model->save();
            return "ok";
        }
        $EmpDept = EmployeeDept::find()->where(['tenant_id' => $model->hsp_id])
        ->select('user_id as id')->all();
        $doctors = RegUser::find()->where(['in', 'id', $EmpDept])->all();
        $model->hsp_id = TenantManager::getTenantId();
        $depts = Dept::find()->where(['tenant_id' => $model->hsp_id, 'active' => true])->all();
        return $this->renderAjax('fee-payment', [
            'model' => $model, 'doctors' => $doctors,'depts'=> $depts
        ]);
        
    }

    protected function getTodaysPatients(){
        $dateNow = strtotime(date("Y-m-d 00:00:00"));
        $today = date("Y-m-d 00:00:00");
        $a = strtotime(date($today))+86400;
        //return Yii::$app->formatter->asDatetime($a, 'php:Y-m-d H:i:s');
        $dataProvider = new ActiveDataProvider([
        'query' => Encounter::find()->innerJoinWith('regUser')->where(
            ['between',
            'registered_at',
             $dateNow,
             $a
            ]
        )->andWhere(['reg_fee' => 0]),
        'sort' => [
            'defaultOrder' => [
                'registered_at' => SORT_ASC,
            ]
        ],
        ]);
        return $dataProvider;
    }
}
