<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\VerbFilter;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Medicine';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicine-index">
    <div id="row-search" style="display: flex; flex-direction:row;">
        <?php
            for($i = 'A'; $i !== 'AA'; $i++){
                echo Html::a($i, Url::to(['filter-medicine','filterLetter' => $i]), ['style' => 'margin: 10px;']);
            }
        ?>
    </div>
    <div id="search">
        <?= Html::textInput(null, null, 
        [
            'id' => 'medicine-search',
            'oninput' => 
            '
            if(this.value.length >= 3){
                $.get("'.Url::to(['search-medicine']).'", {filterLetter: this.value})
                .done(function(data){
                    $("#medicine-list-table").html(data);
                });
            }
            '
        ]) ?>
    </div>
    <div>
        <?php Pjax::begin(['id' => 'medicine-list-table']) ?>
        <?php if ($dataProvider != null): ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'name',
                'composition',
                'manufacturer',
                'mrp',
                [
                    'label'=>'Add',
                    'format'=>'raw',
                    'value' => function($data){
                        return Html::a('Add', ['dose', 'med_id'=>$data->id], 
                        [     
                            'class' => 'btn btn-primary showModalButton', 
                            'title' => "Add Dosage",
                            'value' => Url::to(['default/dose','med_id' => $data->id]),                 
                        ]);
                    }
                ],
            ]
            ]);
        ?>
        <?php endif; ?>
        <?php Pjax::end(); ?>
    </div>
</div>
