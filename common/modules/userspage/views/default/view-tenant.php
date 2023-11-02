<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Hsp $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hsps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hsp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['updatehsp', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'regby_id',
            'email:email',
            'name',
            'mobno',
            'add1',
            'dist',
            'status',
            'type',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
