<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OpdReg $model */

$this->title = 'Update Opd Reg: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Opd Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="opd-reg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
