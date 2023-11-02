<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Department $model */


?>
<div class="department-view">

    <h4><?= Html::encode("Are you sure you want to remove") ?></h4>
    <h4><?= Html::encode(" the Doctor from the Dept.") ?></h4>

    <?php $form = ActiveForm::begin(); ?>    

    <?= Html::textInput('empdept_id', $empdept_id, ['hidden' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Yes', [
                'class' => 'btn btn-success postFormAjax', 
                'pjaxTarget' => 'dr_regusers'
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
