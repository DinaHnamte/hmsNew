<?php

use app\models\Encounter;
use app\models\OpdReg;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'New Appointment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opd-reg-index">

    <?php Pjax::begin(['id' => 'datatable']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'pat_id',
            //'idhsp',
            'chief_complaint',
            //'refdept',
            //'iddr',
            //'admit:boolean',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Encounter $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
