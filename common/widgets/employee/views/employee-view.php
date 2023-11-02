<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */


?>
<div class="staff-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
            'id',
            'idhsp',
            'idreguser',
            'user_id',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
