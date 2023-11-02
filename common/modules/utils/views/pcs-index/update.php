<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PcsIndex $model */

$this->title = 'Update Pcs Index: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pcs Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pcs-index-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
