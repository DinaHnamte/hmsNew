<?php

use app\models\Encounter;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="opd-reg-index">
    <?= GridView::widget([
        'id' => 'opd-patient-list',
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'pat_id',
            'regUser.name',
            'chief_complaint',
            [
              'attribute' => 'registered_at',
              'value' => function ($model) {
                  return \Yii::$app->formatter->asDatetime($model->registered_at, 'php:Y-m-d H:i:s');
              },
            ],
            [
              'label' => 'Record',
                'format' => 'raw',
                'value' => function ($data) {
                    $url =Url::to(['vitalsign/vital-sign/create','encounter_id' => $data->id]) ;

					          return Html::a('Vital Signs',
                    $url, ['value' => $url, 'title' => 'Record Vital Signs', 'class' => 'showModalButton']);
                  }
            ],
            [
              'label' => 'Action',
                'format' => 'raw',
                'value' => function ($data) {
                    $url =Url::to(['fee-payment','id' => $data->id]) ;

					          return Html::a('Select',
                    $url, ['value' => $url, 'title' => 'Register Patient for OPD', 'class' => 'showModalButton']);
                  }
            ],
        ],
    ]); ?>

</div>