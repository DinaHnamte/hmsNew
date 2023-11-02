<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div >
    <?= GridView::widget([
        "id" => 'prescript-table',
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Prescriptions',
                'format'=>'raw',
                'value' => function($data)use($idopd){
                    return $data->medi;
              }
            ],
            'dose',
            [
                'label'=>'Remove',
                'format'=>'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($data)use($idopd){
                    return Html::a('<i class="fa fa-times" style="color:red"></i>', ['prescript-index', 'idopd' => $idopd], 
                    [   'pjaxTarget' => 'priscripttable',
                        'class' => 'postDataAjax',
                        'pdata' => [ 'idprescript' => $data->id, 'idopd'=>$data->encounter_id, 'action'=>"delete"]                        
                    ]);
              }
            ],
        ],
    ]); ?>
</div>


