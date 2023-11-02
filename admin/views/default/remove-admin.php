<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */

?>  

<div id="reguser-detail">
<?= common\widgets\regusers\RegUserView::widget([
            'model'=> $model,
        ]) ?> 
</div>   

</div>

<?php $form = ActiveForm::begin(['action' => ['remove-admin']]); ?>
<?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false) ?>  

<div class="container d-flex align-items-center justify-content-center">

    <?= Html::submitButton('OK', ['class' => 'btn btn-success postPjax', 'pjaxTarget' => 'reguser-list']) ?>


  </div>
<?php ActiveForm::end(); ?>

<?php
$this->registerJs('
   $("document").ready(function(){ 
      $(".postPjax").on("click", function(e){
        e.preventDefault();
        $target = $(this).attr("pjaxTarget");
        $form = $(this).closest("form");
        $formData = $form.serialize();
        //alert($formData);
        $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
          if(data === "ok"){
            $.pjax({container: "#"+$target})
            $("#modal").modal("hide");
          }
        }
      })
   })})
   '
 );
?> 