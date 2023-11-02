<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */


?>
<div class="staff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_employeeform', [
        'model' => $model,
    ]) ?>

</div>
