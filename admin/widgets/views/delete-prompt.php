<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */
?>

<div id="reguser-detail"> 
<div class="main">
  <span><h2>Are you sure you want to delete this record?</h2></span>    
<?php $form = ActiveForm::begin(); ?>  
  <!-- Another variation with a button -->
         
    <?= html::textInput('id2delete',$id2delete,['id'=> 'id2delete', 'hidden' => true]) ?> 
    <div class="input-group-append">    
      <button id="postDeleteAjax" class="btn btn-secondary " targetId= <?= $targetId ?> type="button">
        <i class="fa fa-search"></i>
      </button>
    </div>
  
</div>
<?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs('
   $("document").ready(function(){ 
      $("#postDeleteAjax").on("click", function(e){
        e.preventDefault();
        $target = $(this).attr("targetId");
        $form = $(this).closest("form");
        $formData = $form.serialize();
        //alert($formData);
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

