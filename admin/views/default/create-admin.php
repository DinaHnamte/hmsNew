<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */
?>

<div id="reguser-detail"> 

<div id="reguser-detail">
<?= common\widgets\SearchBox::widget([
            'targetId'=> 'reguser-detail', 'placeholder' => 'Enter e-mail id'
        ]) ?> 
</div> 



<h4><?= Html::encode('Add User to Admin') ?></h4>

<div id="reguser-detail">
<?= common\widgets\regusers\RegUserView::widget([
            'model'=> $model,
        ]) 
?> 
<?php $form = ActiveForm::begin(); ?>  
    <?= html::textInput('user_id',$model->id,['id'=> 'user_id', 'hidden' => true]) ?>
    <div class="container d-flex align-items-center justify-content-center">
    <?php if($enablebtn): ?>
        <?= Html::submitButton('OK', ['class' => 'btn btn-success postPjax', 'pjaxTargetId' => 'reguser-list']) ?>
    <?php endif; ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
</div>

<?php
$this->registerJs('
   $("document").ready(function(){ 
      $(".postPjax").on("click", function(e){
        e.preventDefault();
        $target = $(this).attr("pjaxTargetId");
        $form = $(this).closest("form");
        $formData = $form.serialize();
        //alert($formData);
        $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
          $("#modal").modal("hide");
          if(data === "ok"){
            $.pjax({container: "#"+$target});            
          }
        }
      })
   })})
   '
 );
?>
