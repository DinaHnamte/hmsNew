<?php

use app\models\Encounter;
use app\models\OpdReg;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="opd-reg-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'pat_id',
            //'hsp_id.hsp.name',
            [
              'label'=>'Name',
              'attribute'=>'pat_id',
              'value' => 'regUser.name',
            ],
            [
              'label'=>'Compliant',
              'attribute'=>'pat_id',
              'value' => 'chief_complaint',
            ],
            'chief_complaint',
            [
              'label'=>'Address',
              'attribute'=>'pat_id',
              'value' => 'regUser.add1',
            ],
            [
              'label'=>'Phone',
              'attribute'=>'pat_id',
              'value' => 'regUser.mob',
            ],
            [
                'label'=>'Remove',
                'format'=>'raw',
                'value' => function($data){                  
                  if($data->reg_fee===0){
                    return Html::button(
                        '<i class="fa fa-times" style="color:red"></i>',
                         [
                            'class' => 'encounter-remove',
                            'data-id' => $data->id,
                            'style' => 'border: none'
                         ]
                    );
                }
                return '';
              }              
            ],
        ],
    ]); ?>
</div>

<?php 
$this->registerJs('
   $("document").ready(function(){ 
      $(".encounter-remove").on("click", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
        url: "delete",
        type: "POST",
        data: {id : id},
        success: function (data) {
          if(data == 1){
            $.pjax({container: "#patient-encounter-pjax"})
          }else{
            alert("Something went wrong");
          }
        }
      })
   })})
   '
);
?>