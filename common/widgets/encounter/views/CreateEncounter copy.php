<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Encounter $model */
?>
<div class="encounter-create">


    <?= $this->render('appoinmentForm', [
        'model' => $model,
    ]) ?>

</div>
