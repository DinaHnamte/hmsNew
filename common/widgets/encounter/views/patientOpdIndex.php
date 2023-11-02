<?php

use app\models\Encounter;
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
            [
              'label'=>'Date',
              'attribute'=>'registered_at',
              'value' => 'registered_at',
            ],
            [
              'label'=>'Hospital/Clinic',
              'format'=>'raw',
              'value' => function($data){
                return $data->tenant->name;
              }                 
            ],
            'chief_complaint',
            [
              'label'=>'Doctor',
              'attribute'=>'dr_id',
              'value' => 'regUser.name',
            ],
            [
                'label'=>'Details',
                'format'=>'raw',
                'value' => function($data){  
                    $url = Url::toRoute(['delete', 'id' => $data->id]);
                    $lbl = '<i class="fa fa-times" style="color:red"></i>';
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