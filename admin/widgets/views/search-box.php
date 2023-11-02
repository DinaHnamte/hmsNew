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
  <div class="input-group"> 
    <?= html::textInput('txtemail',null,['id'=> 'txtemail', 
            'class' => 'form-control', 'placeholder' => "Enter email to Search"]) ?> 
    <?= html::textInput('search','search',['id'=> 'search', 'hidden' => true]) ?> 
    <div class="input-group-append">    
      <button id="postSearchAjax" class="btn btn-secondary " targetId= <?= $targetId ?> type="button">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>



<?php
$this->registerJs('
   $("document").ready(function(){ 
      $("#postSearchAjax").on("click", function(e){
        e.preventDefault();
        $target = $(this).attr("targetId");
        $form = $(this).closest("form");
        $formData = $form.serialize();
        alert($formData);
        $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
          if(data){
            $("#"+$target).html(data);
            //$("#modal").modal("hide");
          }
        }
      })
   })})
   '
 );
?> 


