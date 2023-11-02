<?php

use app\models\User;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">

        <p>
            <?= Html::a('OPD Appointment', ["patient/patient/index"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p> 

        <p>
            <?= Html::a('OPD Desk', ["opd/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

        <p>
            <?= Html::a('Doctor', ["doctor/default/index"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

        <p>
            <?= Html::a('HSP ADMIN', ["tenantadmin/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('Vital Signs', ["vitalsign/vital-sign/index"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

    </div>

</div>
