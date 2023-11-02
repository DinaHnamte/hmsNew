<?php

use app\components\widgets\encounter\OpdView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\OpdReg $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Opd Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="opd-reg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= OpdView::widget(['model' => $model]) ?>

</div>
