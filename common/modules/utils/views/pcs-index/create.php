<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PcsIndex $model */

$this->title = 'Create Pcs Index';
$this->params['breadcrumbs'][] = ['label' => 'Pcs Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcs-index-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
