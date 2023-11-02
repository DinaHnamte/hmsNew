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

    <div class="form-group container d-flex align-items-center justify-content-center mt-2 mb-2" >
        <?= Html::button('Submit', ['class' => 'btn btn-success postFormAjax', 'pjaxTarget' => 'patient-encounter']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

