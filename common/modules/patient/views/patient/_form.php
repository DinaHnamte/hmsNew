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

    <?= $form->field($model, 'chief_complaint')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
