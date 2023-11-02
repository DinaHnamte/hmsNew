<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Encounter $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="encounter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'encounter_type')->hiddenInput(['value' => $model->encounter_type])->label(false) ?>

    <?= $form->field($model, 'pat_id')->hiddenInput(['value' => $model->pat_id])->label(false) ?>

    <?= $form->field($model, 'hsp_id')->hiddenInput(['value' => $model->hsp_id])->label(false) ?>

    <?= $form->field($model, 'chief_complaint')->textarea(['id' => 'chief_complaint', 'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::button('Save', ['class' => 'btn btn-success', 'id' => 'patient-encounter-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerJs('
   $("document").ready(function(){ 
      $("#patient-encounter-button").on("click", function(e){
        e.preventDefault();
        $form = $(this).closest("form");
        $formData = $form.serialize();
        $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
          if(data == "done"){
            $("#chief_complaint").val("");
            $.pjax({container: "#patient-encounter-pjax"});            
          }
        }
      })
   })})
   '
);
?>