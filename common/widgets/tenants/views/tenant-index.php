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
            'app_id',            
            'name',
            'email:email',
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
                'visible' => ($actionUrl1 == null? false:true ),
                'value' => function ($data) use($actionUrl1) {
                    $a = json_decode($actionUrl1, true);
                    if($actionUrl1==null){
                        return '';
                    }
                    $url =Url::to([$a['url'],'id' => $data->id]) ;									
					return Html::a($a['label'],
                            $url, [
                                'value' => $url, 
                                'title' => $a['options']['title'], 
                                'class' => $a['options']['class']
                            ]);
                                       
                }
             ],
             [
                'label' => 'Action',
                'format' => 'raw',
                'visible' => ($actionUrl2 == null? false:true ),
                'value' => function ($data) use($actionUrl2) {
                    $a = json_decode($actionUrl2, true);
                    if($actionUrl2==null){
                        return '';
                    }
                    $url =Url::to([$a['url'],'id' => $data->id]) ;									
					return Html::a($a['label'],
                            $url, [
                                'value' => $url, 
                                'title' => $a['options']['title'], 
                                'class' => $a['options']['class']
                            ]);
                                       
                }
             ],
             [
                'label' => 'Action',
                'format' => 'raw',
                'value' => function ($data) use($actionUrl2){
                    $url =Url::to(['/hsp/update','id' => $data->id]) ;									
					return Html::a('<span class="fa fa-edit"></span>',
                     $url, ['value' => $url, 'title' => '', 'class' => 'showModalButton']);
                    
                }
             ],
             
        ],
    ]); ?>
    
</div>
