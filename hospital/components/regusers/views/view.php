<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Reguser $model */

\yii\web\YiiAsset::register($this);
?>
<div class="reguser-view">

    
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
            'id',
            //'user_id',
            //'pwd:boolean',
            'name',
            'fname',
            'dob',
            //'sex',
            //'tribe',
            //'commu',
            //'bg',
            'mobno',
            'add1',
            //'dist',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
