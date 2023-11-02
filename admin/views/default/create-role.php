<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AuthItemModel */


?>
<div class="auth-item-form">
    <?php $form = ActiveForm::begin(); ?> 

    <?= $form->field($model, 'app_id')->dropDownList(
        Yii::$app->params['app-ids'],['prompt'=>'Select'],
        ['required' => true]) ?>
    
    <?= $form->field($model, 'name')->textInput(['required' => true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group justify-content-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success postAjax', 
                                    'pjaxTarget' => 'getroleslist']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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
          }else{
            alert(data);
          }
        }
      })
   })})
   '
 );
?> 





