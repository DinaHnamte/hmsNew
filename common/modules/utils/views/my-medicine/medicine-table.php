<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\VerbFilter;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Medicine';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicine-index">

<div >
        <?= common\widgets\SearchBox::widget([
            'targetId'=> 'medicine-list', 'placeholder' => 'Enter medicine keyword'
        ]) ?> 
</div> 
    <div>
        <?php Pjax::begin(['id' => 'medicine-list']) ?>
        
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'id' => 'medicines',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
                    'composition',
                    ['class' => 'yii\grid\CheckboxColumn'],                 
                ]
            ]);
        ?>
       
        <?php Pjax::end(); ?>
    </div>

    
    <div class="form-group container d-flex align-items-center justify-content-center">
    <?=Html::Button('Add', ['href' => Url::to(['add-medicines']), 
                    'pjaxTarget' => 'medicine-list', 'gridViewId' => 'medicines',
                    'class' => 'btn btn-primary postCheckedAjax']);?>
    </div>
    
</div>

