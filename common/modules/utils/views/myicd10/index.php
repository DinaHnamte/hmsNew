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

$this->title = 'Diagnosis';
$this->params['breadcrumbs'][] = $this->title;
?>
    
    <div id='xxxx'>

    <div class="" >
    <?= Html::a('Add ICD10 Diagnosis', ['icd10'], ['class' => 'btn btn-primary']) ?>
  </div>
  <?php Pjax::begin(['id' => 'myicdcodes-table']); ?>
        <?= GridView::widget([
        'id' => 'diagnosis',        
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				    'label'=>'ICD10 Title',
				    'format'=>'raw',
            'attribute'=>'title',				    
            ],
            [
              'label'=>'',
              'format'=>'raw',
              'contentOptions' => ['class' => 'text-center'],
              'value' => function($data){
                  return Html::a('<i class="fa fa-eye"></i>', ['view-my-icd10', 'med_id'=>$data->id], 
                  [     
                      'class' => ' showModalButton', 
                      'title' => "Medicine Details",
                      'value' => Url::to(['view-my-icd10','myicd_id' => $data->id]),                 
                  ]);
              }
          ],
      ],
    ]); ?>
   <?php Pjax::end(); ?>
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
                idopd :"'. 0 .'"},
                function( data ) {   
                
                $("#xxxx" ).html(data);
                $.pjax({ container: "#diagnosistable"});
                //history.go(0);
            });
		    });
    });'
);
?>
