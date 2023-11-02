<?php

namespace common\modules\doctor\controllers;

use yii;

use common\models\Diagnosis;
use common\models\Dosages;
use common\models\Encounter;
use common\models\Prescript;
use common\models\auth\User;
use common\models\MyIcd10;
use common\models\Icd10;
use common\models\MyMedicines;
use hospital\modules\medicine\models\Medicines;
use Codeception\Lib\Console\Message;
use common\models\auth\RegUser;
use common\models\auth\Tenant;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use hospital\modules\doctor\PrescriptController;
use DateTime;
use kartik\mpdf\Pdf;

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

    /**
     * Lists all Icd10 models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Encounter::find()->innerJoinWith('user');
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'key' => 'id',
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPatHistory()
    {
        $patid = Yii::$app->request->get('pat_id');
        $dataProvider = new ActiveDataProvider([
            'query' => Encounter::find()->where(['pat_id' => $patid]),
            ]);
        return $this->renderAjax('pat-history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDiagnose(){
        
        $opd = Encounter::findOne(Yii::$app->request->get('idopd'));
        $user = User::findOne($opd->pat_id);

        $diagnoseDp = new ActiveDataProvider([
            'query' => Diagnosis::find()->where(['encounter_id' => $opd->id]),
        ]);
        //
        $prescriptDp = new ActiveDataProvider([
            'query' => Prescript::find()->where(['encounter_id' => $opd]),

        ]);
        return $this->render('diagnose', [
            "user" => $user,
            'diagnoseDp' => $diagnoseDp,
            'dataProvider' => $prescriptDp,
            'idopd' => $opd->id,
            'model' =>  $user->regUser
        ]);
    }

    public function actionAddDiagnosis(){

        $idopd = $this->request->get('idopd');
        $model = new Diagnosis();
        if($this->request->post('action') == 'save'){
            if ($this->request->isAjax) {
                $myicd10ids = $this->request->post('myicd10ids'); 
                $idopd = $this->request->post('idopd');
                $rows=array();
                try{            
                    if (is_array($myicd10ids)) {            
                        foreach ($myicd10ids as $id) {  
                            $myicd10 = MyIcd10::findOne($id);             
                            $rows[]= [
                            'encounter_id'   => $idopd,
                            'idmyicd10'   => $id,
                            'icd_code'   => $myicd10->icd10id,
                            'diag'   => $myicd10->title,
                            ];                          
                        }
                        $columns = ['encounter_id', 'idmyicd10','icd_code','diag'];
       
                        Yii::$app->db->createCommand()
                            ->batchInsert('diagnosis', $columns, $rows)
                            ->execute();
                    }
                }
                catch(Exception $e){
                   echo $e->$php_errormsg; 
                }                 
            } 
        }
        // Selects idmyicd10's from diagnosis table where idopd = idopd
        $myicd10ids = Diagnosis::find()->select('idmyicd10')->where(['encounter_id' => $idopd]);        
        
        //Selects from myicd10 where 'id'
        $dataProvider = new ActiveDataProvider([
            'query' => MyIcd10::find()
                    ->where(['not', ['id' => $myicd10ids]])
                    ->andWhere(['user_id' => Yii::$app->user->identity->id]),
            'pagination' => false,
        ]);
        
        return $this->renderAjax('add-diagnosis',[
            'dataProvider' => $dataProvider, 'idopd' => $idopd
        ]);
    }

    //find myicd10 not including ones in diagnostics and where user id = current doctors id 

    public function actionGetDiagnosis()
    {  
        $action = Yii::$app->request->post('action');
        $idopd = Yii::$app->request->get('idopd');     
        $model = new Diagnosis();
        if (Yii::$app->request->isAjax) {
            $idopd = Yii::$app->request->post('idopd');
            if($action = 'delete'){
                $id = Yii::$app->request->post('iddiag');
                Diagnosis::findOne($id)->delete();
                return "ok";
            }                        
        }        
    }

    public function actionCreate()
    {
        $model = new Prescript();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $id = '';
                for ($i = 0; $i < 9; $i++) {
                $id = uniqid();
                if(Prescript::findOne($id) == null){
                   $model->id = uniqid();
                   if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                   }
                }
            }
                
            }
        } else {
            $model->loadDefaultValues();
        }
            $model->id = uniqid();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

public function actionAddPrescription(){
    $idopd = $this->request->get("idopd");
    if($this->request->post('action') == 'save'){
        if ($this->request->isAjax) {
            $dosage_ids = $this->request->post('dosage_keys'); 
            $idopd = $this->request->post('idopd');

            $rows=array();
            try{            
                if (is_array($dosage_ids)) {            
                    foreach ($dosage_ids as $id) {                                                 
                        $dosage = Dosages::findOne($id);
                        $medi = MyMedicines::findOne(['med_id' => $dosage->med_id]);         
                        $rows[]= [
                        'prescript_dt' => Yii::$app->formatter->asDatetime(time(), 'yyyy-MM-dd'),
                        'encounter_id'   => $idopd,
                        'med_id'   => $dosage->med_id,
                        'medi'   => $medi->name,
                        'dose'   => $dosage->dose,
                        ];                          
                    }
                    $columns = ['prescript_dt','encounter_id', 'med_id','medi','dose'];
    
                    Yii::$app->db->createCommand()
                        ->batchInsert('prescript', $columns, $rows)
                        ->execute();
                        //return 'ok';
                }
            }
            catch(Exception $e){
                echo $e;
            }                 
        } 
    }
    $doc_id = Yii::$app->user->identity->id;
    $existingPrescriptions = Prescript::find()->where(['encounter_id' => $idopd ])
                            ->select('med_id')->all();
    $mymed = MyMedicines::find()->where(['doc_id' => $doc_id ])
            ->andWhere(['not in', 'med_id', $existingPrescriptions])
            ->select('med_id')->all();
    $qry = Dosages::find()->where(['med_id' => $mymed]);
    //$qry = Dosages::find()->;
    $prescriptDp = new ActiveDataProvider([
        'query' => $qry,
        'pagination' => false,
    ]);
    return $this->renderAjax("add-prescription", [
        'prescriptDp' => $prescriptDp, 'idopd' => $idopd
    ]);
}

    public function actionPrescriptIndex(){
        $idopd = 0;
        if (Yii::$app->request->isPost) {
            $idopd = Yii::$app->request->post('idopd');
            if($action = 'delete'){
                $id = Yii::$app->request->post('idprescript');
                Prescript::findOne($id)->delete();
                return 'ok';
            }                        
        }
        
        $prescriptDp = new ActiveDataProvider([
            'query' => Prescript::find()->where(['encounter_id' => $opd]),

        ]);
        return $this->renderAjax('prescript-index', [
            'dataProvider' => $prescriptDp,
            'idopd' => $opd->id,
        ]);
    }

    public function actionBarcode(){
        $idopd = $this->request->get("idopd");
        $prescript_id = Prescript::find()->where(['encounter_id' => $idopd ])->select('id')->asArray(true);
        return $this->renderAjax('_barcode', ['prescript_id' => $prescript_id]);
    }

    public function actionPdf(){
        $idopd = $this->request->get('idopd');
        $prescript_id = Prescript::find()->where(['encounter_id' => $idopd ])->select('id')->asArray(true);
        $encounter = Encounter::find()->where(['id' => $idopd])->one();
        $hsp = Tenant::find()->where(['id' => $encounter->hsp_id])->one();
        $patient = RegUser::find()->where(['id' => $encounter->pat_id])->one();
        $diagnosis = Diagnosis::find()->where(['encounter_id' => $idopd]);
        $prescriptions = Prescript::find()->where(['encounter_id' => $idopd]);
        $doctor = RegUser::find()->where(['id' => $encounter->dr_id])->one();

        $filename = Yii::getAlias('@webroot') . '/reports/' . str_replace(' ', '', $patient->name) . date('ymd') .'.pdf';

        $content = $this->renderPartial('_barcode',
            ['prescript_id' => $prescript_id,
             'idopd' => $idopd,
             'encounter' => $encounter,
             'hsp' => $hsp,
             'patient' => $patient,
             'diagnosis' => $diagnosis,
             'prescriptions' => $prescriptions,
             'doctor' => $doctor
            ]
        );

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_FILE, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            //'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            // set mPDF properties on the fly
            'options' => ['title' => 'Report'],
            // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Report'], 
                'SetFooter'=>['{PAGENO}'],
            ],
            'filename' => $filename,
        ]);

        $pdf->render();
        return $filename;
    }
}


