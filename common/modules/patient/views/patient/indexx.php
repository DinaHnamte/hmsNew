<?php

use app\models\Hsp;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Hsps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hsp-index">   
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'regby_id',            
            'name',
            'email:email',
            'mobno',
            //'add1',
            //'dist',
            //'status',
            //'type',
            //'created_at',
            //'updated_at',
             [
                'label' => 'Action',
                'format' => 'raw',
                'value' => function ($data) {
                    $url =Url::to(['create','hsp_id' => $data->id]) ;									
					return Html::a('Select',
                     $url);
                    
                }
             ],
        ],
    ]); ?>

</div>
