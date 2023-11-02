<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Icd10';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="icd10-index">

    
    <?php Pjax::begin(['id' => 'icd10table']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'datatable',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'Level',
            //'Category',
            //'ChapterId',
            //'BlockId',
            //'Dagger',
            'Aster',
            //'WithoutDot',
            'title',
            //'Mortality1',
            //'Mortality2',
            //'Mortality3',
            //'Mortality4',
            //'Mortality5',
            ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    
<div class="container d-flex align-items-center justify-content-center" style = "position: fixed; bottom: 120px;">
    <?=Html::Button('Add', ['id' => 'adddiseases', 'class' => 'btn btn-primary']);?>
</div>
</div>

<?php 
$this->registerJs(
   '$("document").ready(function(){ 
		$("#adddiseases").on("click", function() {
            var keys = $("#datatable").yiiGridView("getSelectedRows");            
            $.post( "'.Yii::$app->urlManager->createUrl('icd10/default/adddiseases').'",
                {icd10ids: keys,
                chapterid : $("#chapterid").val(),
                blockid : $("#blockid").val()},
                function( data ) {  
                alert(data);                      
                $("#blockid").trigger("change");
            });
		});
    });'
);
?>