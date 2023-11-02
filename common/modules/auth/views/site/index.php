<?php

use app\models\User;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">

        <p>
            <?= Html::a('OPD Appointment', ["patient/default/index"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p> 
        
        <p>
            <?= Html::a('OPD Desk', ["opd/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

        
        <p>
            <?= Html::a('Doctor', ["doctor/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('Medicine', ["medicine/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('ICD', ["icd10/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('HSP ADMIN', ["tenantadmin/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>

        <p>
            <?= Html::a('App ADMIN', ["admin/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
    </div>

    
    <?php //if(Yii::$app->hspManager->isStaff(Yii::$app->user->identity->id)): ?>
    <div style="display: flex; align-items:center; justify-content: center;">
        <p>
            <?= Html::a('Doctor', ["doctor/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('Medicine', ["medicine/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
        <p>
            <?= Html::a('ICD', ["icd10/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
         <p>
            <?= Html::a('OPD Desk', ["opd/"],
                ['class' => 'btn btn-outline-secondary']) ?>
        </p>
    </div>
    <?//php endif; ?>
</div>
