<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\OpdReg $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Opd Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="opd-reg-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
            'id',
            'pat_id',
            'hsp_id',
            'chief_complaint',
            'refdept',
            'iddr',
            'admit:boolean',
            'created_at',
        ],
    ]) ?>

</div>
