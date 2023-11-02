<?php

use common\models\Dept;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Add Department', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'tenant_id',
            'name',
            'active:boolean' ,
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Dept $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ], 
                      
        ],
    ]); ?>


</div>
