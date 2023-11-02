<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Reguser $model */

$this->title = 'Update Reguser: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Regusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reguser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
