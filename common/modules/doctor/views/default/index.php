<?php

use app\models\User;
use app\models\Blocks;
use app\models\Chapters;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-index">
    <h3>Patient List:</h3>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'label' => "OPD Id"],
            ['attribute' => 'user.username',
            'label' => 'Patient'],
            ['attribute' => 'chief_complaint',
            'label' => 'Complaint'],
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{diagnose}',
                'buttons' => [
                'diagnose' => function ($url, $model) {

                    $url = Url::to(['default/diagnose','idopd' => $model->id]);
                    
                    return Html::a('<i class="fa fa-stethoscope"></i>', $url, ['class' => 'btn btn-primary']);
                },
            ],
        ],
        ],
    ]); ?>
</div>