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


?>
    
    <div id='xxxx'>
    <center>
        <?= common\widgets\SearchTable::widget([
            'tableId'=> 'diagnosis', 'columnIndex' => 2, 'placeholder' => 'Enter keyword'
        ]) ?> 
    </center> 
    
        <?= GridView::widget([
        'id' => 'diagnosis',        
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'label'=>'ICD Code',
              'format'=>'raw',
              'attribute'=>'icd_code',				    
              ],
            [
				    'label'=>'ICD10 Title',
				    'format'=>'raw',
            'attribute'=>'title',				    
            ],
            [
              'class' => 'yii\grid\CheckboxColumn',
              'contentOptions' => ['class' => 'text-center'],
            ],
      ],
    ]); ?>
    
  <div class="container d-flex align-items-center justify-content-center">
    <?=Html::Button('Add', ['id' => 'adddiag', 'class' => 'btn btn-primary']);?>
  </div>
  </div>

<?php 
$this->registerJs(
   '$("document").ready(function(){ 
		$("#adddiag").on("click", function() {            
            var keys = $("#diagnosis").yiiGridView("getSelectedRows");
            console.log(keys)
            //alert(keys);          
            $.post( "'.Yii::$app->urlManager->createUrl('doctor/default/add-diagnosis').'",
                {myicd10ids: keys,
                action: "save",
                idopd :"'. $idopd .'"},
                function( data ) {   
                
                $("#xxxx" ).html(data);
                $.pjax({ container: "#diagnosistable"});
                //history.go(0);
            });
		    });
    });'
);
?>
