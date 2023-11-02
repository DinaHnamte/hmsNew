<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hsp $model */

$this->title = 'Update Hsp: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hsps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hsp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
