<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */
?>

 
<div class="main">    
<?php $form = ActiveForm::begin(); ?>  
  <!-- Another variation with a button -->
  <div class="input-group w-25 mt-2 mb-2"> 
    <?= html::textInput('txtSearch',null,['id'=> 'txtSearch', 
            'class' => 'form-control', 'tableId' => $tableId, 'placeholder' => 'Enter name to search']) ?>  
    <div class="input-group-append">    
      
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>


<?php
$this->registerJs('
   $("document").ready(function(){ 
    $("#txtSearch").on("keyup", function() {
      var value = $("#txtSearch").val().toLowerCase();
      $table = $(this).attr("tableId");
      $tr =  $("#"+$table+" tr");
      $tr.each(function(index) {                  
              $txt = $(this).find("td").eq(' .$columnIndex .').text().toLowerCase();
              //alert($txt);
              if ($txt.indexOf(value) > -1) {
                $(this).show();
              }
              else {
                $(this).hide();
              }
      });
    })})
   '
 );
?> 

