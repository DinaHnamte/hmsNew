<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tenant $model */

?>
<div class="tenant-view">  
    
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
            'id',            
            'name',
            [
                'label'  => 'Registered By',
                'attribute' => 'regby_id',
                'value' => function ($model, $widget){
                    return $model->regUser->name;
                 },
            ],
            //'regby_id',
            'email:email',
            'mobno',
            'add1',
            'dist',
            //'status',
            'type',
            'created_at',
            //'updated_at',
        ],
    ]) ?>



</div>
