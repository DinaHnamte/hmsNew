<?php

use common\models\Reguser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Regusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reguser-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::button('Create New Company', 
            ['value' => Url::to(['create']), 
            'title' => 'Register User', 
            'class' => 'showModalButton btn btn-success']); ?>
        <?= Html::a('Create Reguser', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'regusers']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => [ 'class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            'pwd:boolean',
            'name',
            'fname',
            //'dob',
            //'sex',
            //'tribe',
            //'commu',
            //'bg',
            //'mobno',
            //'add1',
            //'dist',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reguser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>

</div>
