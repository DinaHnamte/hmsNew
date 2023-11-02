<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Dosages $model */

$this->title = 'Create Dosages';
$this->params['breadcrumbs'][] = ['label' => 'Dosages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosages-create">

    <h4> <?= $medModel->name ?> </h4>

    <div class="dosages-form">
    <div >
        <?php Pjax::begin(['id' => 'dosage-list-table']) ?>

        <?= $this->render('get-dosage', [
            'model' => $model,
            'presentDosages' => $presentDosages, 'med_id'=>$model->id,
        ]) ?>
            
        <?php Pjax::end(); ?>
    </div>

    <?= $this->render('_form_dose', [
        'model' => $model,
        'presentDosages' => $presentDosages,
    ]) ?>

</div>


