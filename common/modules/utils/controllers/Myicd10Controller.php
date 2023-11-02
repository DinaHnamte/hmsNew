<?php

namespace common\modules\utils\controllers;

use yii;
use common\models\utilities\Icd10;
use common\models\utilities\Blocks;
use common\models\MyIcd10;
use common\models\IdspDisease;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\base\Exception;

use function PHPUnit\Framework\once;

/**
 * Icd10Controller implements the CRUD actions for Icd10 model.
 */
class Myicd10Controller extends Controller
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
     * Lists all Icd10 models.
     *
     * @return string
     */

     public function actionIndex(){       
        
        $dataProvider = new ActiveDataProvider([
            'query' => MyIcd10::find()
                    ->where(['user_id' => Yii::$app->user->identity->id]),
            'pagination' => false,
        ]);
        
        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionViewMyIcd10()
    {       
        $myicd_id = $this->request->get('myicd_id');
        $myicd = MyIcd10::find()->where(['id' => $myicd_id])->with('icd10')->one();       
        if($this->request->isPost){
            $myicd->delete();
            return 'ok';
        }
                
        return $this->renderAjax('view-my-icd10',[
            'model' => $myicd
        ]);
    }

    public function actionGetblocks()
    {        
        $chapterid = $this->request->post('chapterid');
        $blocks = Blocks::find()->where(['chapterid' => $chapterid])->all();
        foreach($blocks as $block){
            echo "<option value = '" .$block->id . "'>". $block->title ."</option>";
        }              
    }

    public function actionIcd10()
    {            
        $blockid = $this->request->get('blockid'); 
        
        $dataProvider = new ActiveDataProvider([
            'query' => Icd10::find()->where(['blockid' => $blockid]),            
            'pagination' => false
            
        ]);

        return $this->render('icd10', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGeticd10()
    {        
        $blockid = $this->request->post('blockid');
        $icd10ids = MyIcd10::find()->select('icd10id as id')->where(['blockid' => $blockid])
                                    ->andWhere(['user_id' => Yii::$app->user->identity->id]);
        //VarDumper::dump($icd10ids);
        
        $dataProvider = new ActiveDataProvider([
            'query' => Icd10::find()->select(['id','Aster','title'])
                    ->where(['not in','id',$icd10ids])
                    ->andWhere(['blockid' => $blockid]),
            'pagination' => false,
        ]);

        return $this->renderAjax('geticd10', [
            'dataProvider' => $dataProvider, 
        ]);
                    
    }
    
     public function actionAddDiagnosis(){

        $idopd = $this->request->get('idopd');
        //$model = new Diagnosis();
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
                            'idopd'   => $idopd,
                            'idmyicd10'   => $id,
                            'icd_code'   => $myicd10->icd10id,
                            'diag'   => $myicd10->title,
                            ];                          
                        }
                        $columns = ['idopd', 'idmyicd10','icd_code','diag'];
       
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
        $myicd10ids = Diagnosis::find()->select('idmyicd10')->where(['idopd' => $idopd]);        
        
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

    public function actionAdddiseases()
    {        
        $icd10ids = $this->request->post('icd10ids'); 
        $chapterid = $this->request->post('chapterid');
        $blockid = $this->request->post('blockid');
        
        $rows=array();
        //try{            
            if (is_array($icd10ids)) {            
                foreach ($icd10ids as $id) { 
                    $title = Icd10::findOne($id);
                    $isdp_disease = IdspDisease::find()->where(['icd_code' => $title->Aster])->one();
                    $idsp_id = 0;
                    $idsp_title = $title->title;
                    if($isdp_disease !== null){
                        $idsp_id = $isdp_disease->id;
                        $idsp_title = $isdp_disease->title;
                    }
                    $rows[]= [
                    'user_id'   => Yii::$app->user->identity->id,                     
                    'icd10id'   => $title->id,
                    'icd_code'   => $title->Aster,
                    'title'     => $idsp_title,
                    'idsp_id'   => $idsp_id,
                    ];                          
                }
            }
        // }
        // catch(Exception $e){
        //     return "error";
        // } 
       
       $columns = ['user_id','icd10id','icd_code','title','idsp_id'];
       
       Yii::$app->db->createCommand()
           ->batchInsert('myicd10', $columns, $rows)
           ->execute();
               
        //echo  $chapterid;
        return 'ok';
        //echo $blockid;
    }

    /**
     * Displays a single Icd10 model.
     * @param int $Id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Icd10 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionAddMyIcd10()
    {
        $model = new MyIcd10();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id' => $model->Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
}
