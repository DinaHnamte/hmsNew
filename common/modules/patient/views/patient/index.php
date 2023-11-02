<?php
use common\widgets\encounter\OpdAppointment;
use common\widgets\encounter\PatientOpdIndex;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\OpdReg $model */

$this->title = 'Appointment' ;
$this->params['breadcrumbs'][] = 'Appointment';
?>
<div class="opd-reg-create">
<div class="jumbotron text-center bg-transparent mt-1 mb-10">
   
   <p> 
        <h2><?= Html::encode($hspModel->name) ?></h2>
    </p>
   <p> 
   <h3><u><?= Html::encode($model->encounter_type) ?></u></h3>
    </p>

    <?= OpdAppointment::widget(['model'=> $model]) ?>
</div>
    <?php Pjax::begin(['id' => 'patient-encounter']); ?>
    <?= PatientOpdIndex::widget(['dataProvider'=> $dataProvider]) ?>
    <?php Pjax::end(); ?>
</div>
