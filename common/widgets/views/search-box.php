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
  <div class="input-group w-50 mt-2 mb-2"> 
    <?= html::textInput('txtSearch',null,['id'=> 'txtSearch', 
            'class' => 'form-control ', 'type' => 'email', 'required' => true, 'placeholder' => $placeholder]) ?> 
    <?= html::textInput('search','search',['id'=> 'search', 'hidden' => true]) ?> 
    <div class="input-group-append">    
      <button id="postSearchAjax" value="searchText" class="btn btn-secondary " targetId= <?= $targetId ?> type="button">
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
        //alert($formData);
        $.pjax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        container: "#"+$target,
        data: $formData,
      })
   })})
   '
 );
?> 


