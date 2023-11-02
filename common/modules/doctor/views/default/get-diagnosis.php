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

$this->title = 'diagnose';
//$this->params['breadcrumbs'][] = $this->title;
?>
    
   <div>
      
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'id' => 'mydiagnosis',
    'summary' => '',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label'=>'Diagnosis/Impression',
            'attribute'=>'diag',
                
        ],
        [
            'label'=> 'Remove',
            'format'=>'raw',
            'contentOptions' => ['class' => 'text-center'],
            'value' => function($data)use($idopd){                   
                return Html::a('<i class="fa fa-times" style="color:red"></i>', ['get-diagnosis', 'idopd' => $idopd], 
                [   'pjaxTarget' => 'diagnosistable',
                    'class' => 'postDataAjax',
                    'pdata' => [ 'iddiag' => $data->id, 'idopd'=>$data->encounter_id, 'action'=>"delete"]                        
                ]);
              }
        ],
        ],
    ]);?> 

    
</div>


 

 