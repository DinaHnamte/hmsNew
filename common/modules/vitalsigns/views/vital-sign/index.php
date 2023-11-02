<?php

use common\models\VitalSign;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pcs Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcs-codes-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Record Vital Sign', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pat_id',
            'encounter_id',
            'type',
            'value',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VitalSign $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
