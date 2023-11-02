<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Hsp $model */

$this->title = 'Create Hsp';
$this->params['breadcrumbs'][] = ['label' => 'Hsps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hsp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_hspform', [
        'model' => $model,
    ]) ?>

</div>
