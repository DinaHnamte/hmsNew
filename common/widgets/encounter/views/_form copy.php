<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Encounter $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="encounter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'encounter_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pat_id')->textInput() ?>

    <?= $form->field($model, 'hsp_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chief_complaint')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_dept')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dr_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admit')->checkbox() ?>

    <?= $form->field($model, 'reg_fee')->textInput() ?>

    <?= $form->field($model, 'registered_at')->textInput() ?>

    <?= $form->field($model, 'counter_at')->textInput() ?>

    <?= $form->field($model, 'session_start_at')->textInput() ?>

    <?= $form->field($model, 'session_end_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
