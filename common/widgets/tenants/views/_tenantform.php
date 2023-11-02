<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Hsp $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php


?>

<div class="hsp-hspform">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'ajaxform']]); ?>

    <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false) ?>

    <?= $form->field($model, 'regby_id')->hiddenInput(['value'=> $model->regby_id])->label(false) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email', 'required' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'add1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=> $model->status])->label(false) ?>

    <?= $form->field($model, 'type')->dropDownList(
            ['hospital' => 'Hospital', 'clinic' => 'Clinic'],          // Flat array ('id'=>'label')
            ['prompt'=>'Select']    // options
        ) ?>     

    <div class="container d-flex align-items-center justify-content-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success submitAjax']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
