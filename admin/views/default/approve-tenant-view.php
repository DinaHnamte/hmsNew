<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


?>

  <?= 
        common\widgets\tenants\TenantView::widget([
            'model'=> $model,
        ]) 
  ?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false) ?>
<?= $form->field($model, 'status')->hiddenInput(['value'=> $model->status])->label(false) ?>    

<div class="container d-flex align-items-center justify-content-center">
    <?= Html::submitButton('OK', ['class' => 'btn btn-success postAjax', 
                          'pjaxTarget' => 'approve-tenant-index']) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
$this->registerJs('
   $("document").ready(function(){ 
      $(".postAjax").on("click", function(e){
        e.preventDefault();
        $target = $(this).attr("pjaxTarget");
        $form = $(this).closest("form");
        $formData = $form.serialize();
        $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
          if(data == "ok"){
            $.pjax({container: "#"+$target})
            $("#modal").modal("hide");
          }
        }
      })
   })})
   '
 );
?>    