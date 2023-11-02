<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\Dosages $model */
/** @var yii\widgets\ActiveForm $form */
?>

   

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'med_id')->hiddenInput(['value'=> $model->med_id, 'id' => 'med-id'])->label(false) ?>

    <?= $form->field($model, 'dose')->textarea(['maxlength' => true, 'id' => 'dose', 'required' => 'true']) ?>

    <div class="form-group container d-flex align-items-center justify-content-center mt-2">
        <?= Html::button('Save', ['class' => 'btn btn-success ', 'id' =>'btn', ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php 
$this->registerJs(
   '$("document").ready(function(){ 
		$(".btn").on("click", function(e) {            
            e.preventDefault();
            var array = $("form").serializeArray()
            //alert(array)          
        //alert($(e.target).attr("href"));        
            $.post("'.Url::to(['dose', "med_id" => yii::$app->request->get("med_id")]).'",
                array,
                function( data ) {
                $("#modalContent" ).html(data);
                //alert(data);
                //$.pjax({ container: "#dosage-list-table"});
                return false;
            });
		});
        return false;
    });
    '
);
?>

