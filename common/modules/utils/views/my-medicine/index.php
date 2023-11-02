<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\VerbFilter;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'MyMedicines';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <div class="" >
        <?= Html::a('Add to My Medicines', ['medicine-table'], ['title'=> 'Add Medicines', 
                'value' => Url::to(['medicine-table']), 
                'class' => 'btn btn-primary showModalButton']) ?>
    </div>

    <?php Pjax::begin(['id' => 'medicine-list-table']) ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            //'composition',
            //'manufacturer',
            //'mrp',
            [
                'label'=>'Add',
                'format'=>'raw',
                'value' => function($data){
                    return Html::a('Doses', ['dose', 'med_id'=>$data->id], 
                    [     
                        'class' => ' showModalButton', 
                        'title' => "Add Dosage",
                        'value' => Url::to(['dose','med_id' => $data->id]),                 
                    ]);
                }
            ],
            [
                'label'=>'Details',
                'format'=>'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($data){
                    return Html::a('<i class="fa fa-eye"></i>', ['view-my-med', 'med_id'=>$data->id], 
                    [     
                        'class' => ' showModalButton', 
                        'title' => "Medicine Details",
                        'value' => Url::to(['view-my-med','med_id' => $data->id]),                 
                    ]);
                }
            ],
        ]
        ]);
    ?>
    
    <?php Pjax::end(); ?>
</div>

