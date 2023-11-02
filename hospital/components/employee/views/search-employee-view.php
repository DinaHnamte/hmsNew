<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */


?>
<div class="search-reguser-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search...">
        <button type="button" class="btn bg-transparent" style="margin-left: -40px; z-index: 100;">
        <i class="fa fa-times"></i>
        </button>
    </div>

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
