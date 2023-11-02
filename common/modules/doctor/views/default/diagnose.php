<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Prescript;
use app\models\Diagnosis;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Consultation';
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
    <h3><?= 
        Html::a( $model->name,
        ['default/add-diagnosis',
            'idopd' => Yii::$app->request->get('idopd')],
        [
            'value' => Url::to(['pat-history','pat_id' => $model->id]), 
            'title' => 'Patient Medical History', 
            'class' => 'showModalButton',
        ])
        
        .', '.$model->fname.', Age :'.$model->dob ?></h3>
    </p>
    

    <div class="pull-right">
        <?= Html::a('Add Diagnosis',
        ['default/add-diagnosis',
            'idopd' => Yii::$app->request->get('idopd')],
        [
            'value' => Url::to(['add-diagnosis','idopd' => Yii::$app->request->get('idopd')]), 
            'title' => 'Add Diagnosis/Impression', 
            'class' => 'showModalButton',
        ]) ?>
        
    </div>
    <?php Pjax::begin(['id' => 'diagnosistable']); ?>
    <?php    
          echo   $this->renderAjax('get-diagnosis',[
                    'dataProvider' => $diagnoseDp, 'idopd' => $idopd
                ]);                
    ?>
    <?php Pjax::end(); ?>

    <div class="form-group float-right">
    <?= Html::a('Add Prescription',
        ['add-prescription',
            'idopd' => Yii::$app->request->get('idopd')],
        [
            'value' => Url::to(['add-prescription','idopd' => Yii::$app->request->get('idopd')]), 
            'title' => 'Add Prescription', 
            'class' => 'showModalButton',
        ]) 
        ?>
     </div>
    <p>

    <div id='priscripttablex'>
    <?php Pjax::begin(['id' => 'priscripttable']); ?>
    <?php    
          echo   $this->render('prescript-index',[
                    'dataProvider' => $dataProvider, 'idopd' => $idopd
                ]);                
    ?>
    <?php Pjax::end(); ?>
    </div>
    </p>

    <div class="container d-flex align-items-center justify-content-center">
    <div class = "me-5">
    <?=Html::Button('Admit', ['class' => 'btn btn-primary ']);?>
    </div>  
    <div  class = "ms-5">
    <?=Html::Button('Done', ['class' => 'btn btn-primary', 'id' => 'pdf']);?>
    </div>
    </div>
  
    <div>
        <?= Html::a('barcode', Url::to(['barcode', 'idopd' => $idopd]))?>
    </div>
    <div>
        <?= Html::a('pdf', Url::to(['pdf', 'idopd' => $idopd, 'user' => $user]))?>
    </div>

    
<?php  
    $this->registerJs(
    '$("document").ready(function(){ 
            $("#pdf").on("click", function() {        
                $.get( "'.Url::to(['pdf', 'idopd' => $idopd, 'user' => $user]).'",
                    function( data ) {   
                    alert("Report generated Successfully \n" + data);
                    //history.go(0);
                });
                });
        });'
    );
?>

