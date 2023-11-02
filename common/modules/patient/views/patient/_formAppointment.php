<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OpdReg $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="opd-reg-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idpat')->hiddenInput(['value'=> $model->idpat])->label(false) ?>

    <?= $form->field($model, 'idhsp')->hiddenInput(['value'=> $model->idhsp])->label(false) ?>

    <?= $form->field($model, 'cplaint')->textarea(['rows' => '6', 'required' => true]) ?>

    <div class="container d-flex align-items-center justify-content-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success submitAjax']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
