
<?php


use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\html;


?>

<?= DetailView::widget([
    'model' => $reguserModel,
    'attributes' => [        
        'id',
        'name',
        'fname',
        'dob',
        [
            'label'  => 'Gender',
            'value'  => function($reguserModel){					
                return $reguserModel->sex; 
            }
        ],
        'tribe',
        'commu',
        'bg',
        'pwd:boolean',        
        'mobno',
        'add1',
        'dist',
        'regUser.created_at',
        //'updated_at',
    ],
]) ?>


<div class="reguser-view">
    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>
    <div class="form-group container d-flex align-items-center justify-content-center">
        <?= Html::submitButton('Remove Employee', ['class' => 'btn btn-success postAjax', 
                          'pjaxTarget' => 'regusers']) ?>
    </div>
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
          }
        }
      })
   })})
   '
 );
?>