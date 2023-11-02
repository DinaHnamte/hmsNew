<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PcsCodes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pat_id')->hiddenInput(['value' => $model->pat_id])->label(false) ?>

    <?= $form->field($model, 'encounter_id')->hiddenInput(['value' => $model->encounter_id])->label(false) ?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->params['vitalsigns'],['prompt'=>'Select', 'required' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['required' => true]) ?>

    <div class="form-group mt-2 mb-2">
        <center>
            <?= Html::Button('Save', ['class' => 'btn btn-success postFormAjax', 
                        'targetId' => 'modalContent', 'value' => 'save']) ?>
        </center>
    </div>

    <?php ActiveForm::end(); ?>

</div>
