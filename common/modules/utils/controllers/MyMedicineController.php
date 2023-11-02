<?php

namespace common\modules\utils\controllers;

use common\models\Dosages;
use common\models\MyMedicines;
use yii;
use common\models\auth\User;
use common\models\Medicines;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Exception;

/**
 * Icd10Controller implements the CRUD actions for Icd10 model.
 */
class MyMedicineController extends Controller
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
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MyMedicines::find()->where(['doc_id' => Yii::$app->user->identity->id]),
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionMedicineTable()
    {
        $name = '@#$';
        if($this->request->post('txtSearch')){
            $name = $this->request->post('txtSearch');              
        }
        $mymed_ids = MyMedicines::find()->select('med_id as id')
                ->where(['doc_id' => Yii::$app->user->identity->id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => Medicines::find()
            ->where(['like', 'name', '%'. $name . '%', false])
            ->andwhere(['not in', 'id', $mymed_ids]),
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
        return $this->renderAjax('medicine-table', [
            'dataProvider' => $dataProvider, 'id' => Yii::$app->user->identity->id
        ]);
    }

    public function actionAddMedicines()
    {        
        if($this->request->isPost){            
                $med_ids = $this->request->post('checked_ids');
                $rows=array();            
                foreach($med_ids as $id){ 
                    $med = Medicines::findOne($id);                    
                    $x = MyMedicines::find()->where(['med_id' => $med->id, 
                            'doc_id' => Yii::$app->user->identity->id])->count();
                    if($x == 0){
                        $rows[]= [
                            'doc_id'   => Yii::$app->user->identity->id,                     
                            'med_id'   => $med->id,
                            'name'   => $med->name,
                            ];
                    }                        
                }
                $columns = ['doc_id','med_id','name'];       
                Yii::$app->db->createCommand()
                    ->batchInsert('mymedicines', $columns, $rows)
                    ->execute();
                return 'ok';  
            } 
            return 'Something went wrong';        
    }

    public function actionViewMyMed()
    {     
        $med_id = $this->request->get('med_id') ;        
        if($this->request->isPost){            
            //$med_id = $this->request->post('med_id');                    
            $mymed = MyMedicines::findOne($med_id)->delete();
            return 'ok';
        } 
        $meds_in_db = new ActiveDataProvider([
            'query' => Dosages::find()->where(['med_id' => $med_id]),
        ]);
        $mymed = MyMedicines::findOne($med_id);
        return $this->renderAjax('view-my-med', [
            'model' => $mymed, 'presentDosages' => $meds_in_db,
        ]);
    }

    public function actionFilterMedicine(){
        $filterLetter = $this->request->get("filterLetter");
        $my_medicines_ids = MyMedicines::find()->select('med_id');
        $medicines = new ActiveDataProvider([
            'query' => Medicines::find()->where(['like','name', $filterLetter . '%', false])->andWhere(['NOT IN', 'id', $my_medicines_ids]),
        ]);
        return $this->render('index', ['dataProvider' => $medicines]);
    }

    public function actionSearchMedicine(){
        $filterLetter = $this->request->get('filterLetter');
        $my_medicines_ids = MyMedicines::find()->select('med_id');
        $medicines = new ActiveDataProvider([
        'query' => Medicines::find()->where(['like', 'name', $filterLetter . '%', false])->andWhere(['NOT IN', 'id', $my_medicines_ids]),
        ]);
        return $this->renderPartial('medicine-table',['dataProvider' => $medicines]);
    }

    public function actionAddMyMedicine(){
        $medicine_id = $this->request->post('med_id');
        $user_id = 1000000;
        $model = new MyMedicines();
        $model->doc_id = $user_id;
        $model->med_id = $medicine_id;
        $result = $model->save(false);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Creates a new Dosages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionDose($med_id)
    {
        $model = new Dosages();
        $mymed = MyMedicines::findOne($med_id);

        if ($this->request->isPost) {
            $rows=array();
        try{
            $model->load($this->request->post());            
            $dose = new Dosages();            
            $texts = $model->dose;
            $splitted = preg_split("/\r\n|\n|\r/", $texts);
                foreach ($splitted as $dose) { 
                    if($dose!==''){
                        $rows[] = [
                        'med_id'   => $mymed->med_id,
                        'dose' => $dose
                    ]; 
                    }           
                }          
            }
            catch(Exception $e){
            echo $e->$php_errormsg; 
            } 
       
            $columns = ['med_id', 'dose'];            
            Yii::$app->db->createCommand()
                ->batchInsert('dosages', $columns, $rows)
                ->execute();
        }
        //
        $model->med_id = $mymed->med_id;
        $meds_in_db = new ActiveDataProvider([
            'query' => Dosages::find()->where(['med_id' => $mymed->med_id]),
        ]);
        return $this->renderAjax('dose', [
            'model' => $model, 'medModel' => $mymed, 'presentDosages' => $meds_in_db
        ]);
    }

    public function actionGetDose($med_id)
    {
        $model = new Dosages();
        $med = Medicines::findOne($med_id);        
        //
        $model->med_id = $med->id;
        $meds_in_db = new ActiveDataProvider([
            'query' => Dosages::find()->where(['med_id' => $med->id]),
        ]);
        return $this->renderAjax('get-dosage', [
            'presentDosages' => $meds_in_db,
        ]);
    }

    /**
     * Updates an existing Icd10 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id)
    {
        $model = $this->findModel($Id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Icd10 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id)
    {
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Icd10 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Icd10 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = User::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
