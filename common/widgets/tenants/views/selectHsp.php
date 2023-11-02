<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */


?>
<div class="tenant-index">  
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'app_id',            
            'name',
            //'email:email',
            'mobno',
            'add1',
            //'dist',
            //'status',
            //'type',
            //'created_at',
            //'updated_at',
            
            [
                'label' => 'Action',
                'format' => 'raw',
                'value' => function ($data){								
					return Html::a('Select',['index','id' => $data->id]);                                       
                }
             ],            
             
        ],
    ]); ?>
    
</div>
