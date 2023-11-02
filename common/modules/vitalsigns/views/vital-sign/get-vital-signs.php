<?php

use common\models\VitalSign;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pcs Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcs-codes-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'pat_id',
            //'encounter_id',
            [
                'label'=> 'Type',
                'format'=>'raw',
                'value' => function($data){                   
                    return Yii::$app->params['vitalsigns'][$data->type];
                }
            ],
            [
                'label'=> 'Value',
                'format'=>'raw',
                'value' => function($data){                   
                    return $data->value;
                }
            ],
            [
                'label'=> 'Remove',
                'format'=>'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($data){                   
                    return Html::a('<i class="fa fa-times" style="color:red"></i>', 
                            ['create', 'encounter_id' => $data->encounter_id], 
                    [   'targetId' => 'modalContent',
                        'class' => 'postDataAjax',
                        'pdata' => [ 'id' => $data->id, 'action' => 'delete']                        
                    ]);
                  }
            ],
            
        ],
    ]); ?>


</div>
