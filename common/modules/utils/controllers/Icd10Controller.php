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
class Icd10Controller extends Controller
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
        $blockid = $this->request->get('blockid');        
        
        $dataProvider = new ActiveDataProvider([
            'query' => Icd10::find()->where(['blockid' => $blockid]),            
            'pagination' => false
            
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
        return 'Diseases added successfully.';
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
    public function actionAddMyMedicine()
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
        if (($model = Icd10::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
