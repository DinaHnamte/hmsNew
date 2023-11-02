<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Staff $model */


?>
<div class="staff-create">

    
    <?= $this->render('_employeeform', [
        'model' => $model,
    ]) ?>

</div>
