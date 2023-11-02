<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Reguser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php

$this->registerJs(
   '$("document").ready(function(){ 
		$("#new_user").on("pjax:end", function() {
			$.pjax.reload({container:"#regusers"});  //Reload GridView
		});
    });'
);
?>

<div class="reguser-form">
<?php Pjax::begin(['id' => 'new_user']); ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>    
 
    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $model->user_id])->label(false) ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'sex')->dropDownList(Yii::$app->params['gender'],['prompt'=>'Select']) ?>

    <?= $form->field($model, 'tribe')->dropDownList(Yii::$app->params['caste'],['prompt'=>'Select']) ?>

    <?= $form->field($model, 'commu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->dropDownList(Yii::$app->params['religion'],['prompt'=>'Select']) ?>

    <?= $form->field($model, 'bg')->dropDownList(Yii::$app->params['blgroup'],['prompt'=>'Select']) ?>

    <?= $form->field($model, 'mobno')->textInput(['type' => 'number', 'maxlength' => true]) ?>

    <?= $form->field($model, 'add1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pwd')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
