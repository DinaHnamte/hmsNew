<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PcsIndex $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pcs Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pcs-index-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        
        <?= Html::a('Delete', ['view-my-med', 'med_id' => $model->id], [
            'class' => 'btn btn-danger postDataAjax', 
            'pjaxTarget' => 'medicine-list-table',
            'pdata' => ['med_id' => $model->id,
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'  => 'Name',
                'value'  => function($model){					
                    return $model->name; 
                }
            ],
            
        ],
    ]) ?>

    <div>
        <?= GridView::widget([
            'id' => 'dosage-grid',
            'summary' => '',
            'dataProvider' => $presentDosages,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                'dose',
            ]
            ]);
        ?>
    </div>

</div>
