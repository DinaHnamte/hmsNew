<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Prescript $model */
/** @var yii\data\ActiveDataProvider $dataProvider */


?>
    <div id="prescript">
    <center>
        <?= common\widgets\SearchTable::widget([
            'tableId'=> 'prescript', 'columnIndex' => 1, 'placeholder' => 'Enter keyword'
        ]) ?> 
    </center> 
    
    <?= GridView::widget([
        'id' => 'prescript',
        'summary' => '',
        'dataProvider' => $prescriptDp,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => "Medicine",
                'format' => 'raw',
                'attribute' => 'myMedicines.name'
            ],
            [
                'label'=>'Dosage',
                'format'=>'raw',
                'attribute'=>'dose',				    
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                //'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    
    <div class="container d-flex align-items-center justify-content-center" >
    <?=Html::Button('Add Pres', ['id' => 'addpress', 'class' => 'btn btn-primary']);?>
    </div>
    </div>

<?php 
$this->registerJs(
   '$("document").ready(function(){ 
		$("#addpress").on("click", function() {            
            var keys = $("#prescript").yiiGridView("getSelectedRows");
            console.log(keys)
            //alert(keys);          
            $.post( "'.Yii::$app->urlManager->createUrl('doctor/default/add-prescription').'",
                {dosage_keys: keys,
                action: "save",
                idopd :"'. $idopd .'"},
                function( data ) {   
                
                $("#prescript" ).html(data);
                $.pjax({ container: "#priscripttable"});
                //history.go(0);
            });
		    });
    });'
);
?>


