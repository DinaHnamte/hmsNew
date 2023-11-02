<?php

use common\models\Dept;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'tenant_id',
            'name',            
            [
                'label'=>'',
                'format'=>'raw',
                'value' => function($data){					
                return Html::a('Assign', ['assign-dept', 'id' => $data->id], [     
                'class' => ' postDataAjax',
                'pjaxTarget' => 'dr_regusers',
                'pdata' => [ 'emp_id' => Yii::$app->request->get('emp_id'), 'dept_id'=>$data->id]                        
            ]);	 
				}
                
            ],
        ],
    ]); ?>


</div>

