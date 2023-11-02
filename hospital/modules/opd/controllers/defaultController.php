<?php

namespace hospital\modules\opd\controllers;

use common\models\Encounter;
use yii;
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
        return $this->renderAjax('fee-payment', [
            'model' => $model, 'doctors' => $doctors,
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
