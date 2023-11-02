<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Reguser $model */

$this->title = 'Create Reguser';
$this->params['breadcrumbs'][] = ['label' => 'Regusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reguser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
