<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Reguser $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'My Page', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'My Profile';
\yii\web\YiiAsset::register($this);
?>
<div class="reguser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'fname',
            'dob',
            'sex',
            'tribe',
            'commu',
            'bg',
            'pwd:boolean',
            'mobno',
            'add1',
            'dist',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
