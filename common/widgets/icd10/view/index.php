<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="icd10-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Level',
            'Category',
            'ChapterId',
            'BlockId',
            //'Dagger',
            //'Aster',
            //'WithoutDot',
            //'Title',
            //'Mortality1',
            //'Mortality2',
            //'Mortality3',
            //'Mortality4',
            //'Mortality5',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Icd10 $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
